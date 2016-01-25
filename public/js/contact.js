$(document).ready( function() {
    var addresses = [], addressList = [];

    function formatData() {
        var returnData = addressList.filter(addressMatch);
        returnData.forEach(function(item) {
            var value = { "id": item.id, "text": item.address_st+", "+item.address_no }
            addresses.push(value);
        });
    }

    function addressMatch(value) {
        var check = $('#address-list-1').val();
        if ( value.address_st.indexOf(check) !== -1 || value.address_town.indexOf(check) !== -1 ) {
            return value;
        }
    }

    $.get("http://localhost/~carlos/laravel/public/api/contacts").then(function( data, status, jqXHR ){
        data.forEach(function(item) {
            addressList.push(item);
        });
        formatData();
    }).then(function () {
        $('#address-list-1').select2();
        $('#address-list-2').select2({
            data: addresses,
            placeholder: "Select an option",
        });
        $('#user-list').select2({
            tags: true
        });
    });

    $( "#address-list-1" ).change(function() {
        addresses = [];
        formatData();
        $('#address-list-2').select2().empty();
        $('#address-list-2').select2({ data: addresses});
    });

    $('#address-list-1').select2();
    $('#address-list-2').select2({
        data: addresses,
        tags: "true",
        placeholder: "Select an option",
    });
    $('#user-list').select2({
        tags: true
    });
});