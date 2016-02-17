$(document).ready( function() {
    var areas= [], streets = [];
    var electDivs = $("#address-list-0");
    var area = $("#address-list-1");
    var street = $("#address-list-2");

    $('#user-list').select2({ tags: true });
    electDivs.on("select2:select", getAreas);
    area.on("select2:select", getStreets);
    electDivs.select2();
    getAreas();

    function getAreas() {
        area.select2().empty();
        $.ajax({
            url: "http://localhost/~carlos/sidepros/laravel/public/api/contacts",
            // url: "http://socdems.carlostighe.com/public/api/contacts",
            data: { type: "electoral_div", "value": electDivs.val() }
        }).done(function( data, status, jqXHR ) {
            area.select2({ data: data });
            getStreets();
        });
    }

    function getStreets() {
        var sts = street.val();
        street.select2().empty();
        $.ajax({
            url: "http://localhost/~carlos/sidepros/laravel/public/api/contacts",
            // url: "http://socdems.carlostighe.com/public/api/contacts",
            data: { type: "street", "value": area.val() }
        }).done(function( data, status, jqXHR ) {
            street.select2({
                data: data,
                multiple: true
            });
        });
    }
});