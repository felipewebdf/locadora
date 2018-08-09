$().ready(function() {

    app = {
        inputErros: function(data) {
            $.each(data.responseJSON.errors, function(k, v) {
                var errors = v;

                if (v.length > 1) {
                    errors = v.join(',');
                }

                $('<span class="text-danger" id="erro_'+k+'">'+ errors +'</span>')
                        .insertAfter('*[name='+k+']');
            });
        },
        getCookie: function (n) {
            let a = `; ${document.cookie}`.match(`;\\s*${n}=([^;]+)`);
            return a ? a[1] : '';
        },
        setCookie: function(c_name, value, exdays) {
            var exdate = new Date();
            exdate.setDate(exdate.getDate() + exdays);
            var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
            document.cookie = c_name + "=" + c_value;
        }
    };

    $.ajaxSetup({
        headers: {
            'Authorization': app.getCookie('authorization')
        }
    });
});
