$(document).ready(function() {
    var areas= [], streets = [];
    var electDivs = $("#address-list-0");
    var area = $("#address-list-1");
    var street = $("#address-list-2");

    electDivs.on("select2:select", getAreas);
    area.on("select2:select", getStreets);
    street.on("select2:select", addSelection);
    $("#picks").on('click', '.remove', removeSelection);
    $('form').submit(addSelectionsToForm);

    electDivs.select2();
    getAreas();

    function removeSelection(selection) {
        $(this).parent().remove();
    }

    function addSelection(selection) {
        var data = selection.params.data;
        console.log(data  , " - data ");
        var li = '<li class="list-group-item" value="'+ data.text +'"><span class="remove btn-default">x</span><span class="badge">'+data.occurences+'</span>'+data.text+'</li>';
        $("#picks").append(li);
    }

    function addSelectionsToForm() {
        var streets = [];
        $('#picks li').each(function() { streets.push($(this).attr('value')) });
        $(this).append('<input type="hidden" name="streets" value="'+streets+'" /> ');
        return true;
    }

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