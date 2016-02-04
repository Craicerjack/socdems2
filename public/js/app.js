// app.js

$.ajaxSetup({
    // force ajax call on all browsers
    cache: false,

    // Enables cross domain requests
    crossDomain: true,

    // Helps in setting cookie
    xhrFields: {
        withCredentials: true
    },

    beforeSend: function (xhr, type) {
        // Set the CSRF Token in the header for security
        if (type.type !== "GET") {
            var token = Cookies.get("XSRF-TOKEN");
            xhr.setRequestHeader('X-XSRF-Token', token);
        }
    }
});