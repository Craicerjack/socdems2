$(document).ready( function() {
    var areas = [], streets = [], addressList = [];

    function getAreas() {
        var check = $('#address-list-0').val();
        $.ajax({
            url: "http://localhost/~carlos/sidepros/laravel/public/api/contacts",
            data: {
                "type": "electoral_div",
                "value" : check
            }
        }).done(function( data, status, jqXHR ){
            data.forEach(function(item) {
                (item.address_town === "") ?  item.address_town = item["address_st"] : item.address_town = item['address_town'];
                if($.inArray(item.address_town, areas) === -1) {
                    areas.push(item.address_town);
                }
            });
            $('#address-list-1').select2({ data: areas });
        }).then(function() {
            getStreets();
        });
    }

    function getStreets() {
        var check = $('#address-list-1').val() || areas[0];
        $.ajax({
            url: "http://localhost/~carlos/sidepros/laravel/public/api/contacts",
            // url: "http://socdems.carlostighe.com/public/api/contacts",
            data: {
                "type": "address",
                "value" : check
            }
        }).done(function( data, status, jqXHR ){
            data.forEach(function(item) {
                var value = { "id": item.id, "text": item.address_st+", "+item.address_no };
                streets.push(value);
            });
            $('#address-list-2').select2({ data: streets });
        });
    }

    function resetValues(value) {
        if(value === "areas") {
            areas = [];
            getAreas();
            $('#address-list-1').select2().empty();
            $('#address-list-1').select2({ data: areas });
            resetValues("streets");
        }
        if(value === "streets") {
            streets = [];
            getStreets();
            $('#address-list-2').select2().empty();
            $('#address-list-2').select2({ data: streets});
        }
    }

    $('#user-list').select2({ tags: true });
    getAreas();
    $( "#address-list-0" ).change(function() { resetValues("areas") });
    $( "#address-list-1" ).change(function() { resetValues("streets") });

});