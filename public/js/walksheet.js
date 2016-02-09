$(document).ready(function() {
    var areas = [], streets = [];

    function getAreas(){
        var check = $("#address-list-0").val();
        $.ajax({
            url: "http://localhost/~carlos/sidepros/laravel/public/api/contacts",
            // url: "http://socdems.carlostighe.com/public/api/contacts",
            data: { type: "electoral_div", "value": check }
        }).done(function( data, status, jqXHR ) {
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
        var list = $('#address-list-2').select2();
        // var $exampleMulti = $(".js-example-programmatic-multi").select2();
        var sts = arguments[0];

            console.log(sts , " - sts ");
        console.log(check , " -  test  ");
        $.ajax({
            url: "http://localhost/~carlos/sidepros/laravel/public/api/contacts",
            // url: "http://socdems.carlostighe.com/public/api/contacts",
            data: {
                "type": "street",
                "value" : check
            }
        }).done(function( data, status, jqXHR ){
            console.log(streets , " - streets ");
            $.each(data, function(key, value) {
                streets.push(value);
                // streets.push({"id": key, "text": value });
            });
            console.log(streets  , " - streets after ");
            console.log(sts , " - sts in ajax callback ");
            $('#address-list-2').select2({ data: streets, multiple: true, tags: true, val: sts });
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
            var sts = $('#address-list-2').val();
            $('#address-list-2').select2().empty();
            $('#address-list-2').select2().val(sts);
            streets = [];
            getStreets(sts);
        }
    }
    getAreas();

    $( "#address-list-0" ).change(function() { resetValues("areas") });
    $( "#address-list-1" ).change(function() { resetValues("streets") });

});