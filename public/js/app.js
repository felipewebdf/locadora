$().ready(function() {

    app = {
        inputErros: function(data) {
            $.each(data.responseJSON.errors, function(k, v) {
                var errors = v;

                if (v.length > 0) {
                    errors = v.join(',');
                }

                $('<span class="text-danger errors-app" id="erro_'+k+'">'+ errors +'</span>')
                        .insertAfter('*[name='+k+']');
            });
        },
        getCookie: function (name) {
            var cookie = decodeURIComponent(document.cookie);
            var v = cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
            return v ? v[2] : null;
        },
        setCookie: function(c_name, value, exdays) {
            var exdate = new Date();
            exdate.setDate(exdate.getDate() + exdays);
            var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
            document.cookie = c_name + "=" + c_value;
        },
        alert: function(message, type) {
            $('#alert-content').empty().html($('#alert-model').html());
            $('#alert-app').removeClass('alert-warning')
                    .removeClass('alert-danger')
                    .removeClass('alert-success');
            $('#alert-app')
                    .removeClass('hide')
                    .addClass('show')
                    .addClass('alert-' + type);
            $('#alert-message').html(message);
        },
        login: {
            logout: function() {
                $.get('/api/logout', {token: app.getCookie('Authorization').substring('7')},function() {
                    app.setCookie('Authorization','', -1);
                    window.location.href='/';
                });
            }
        },
        http: {
            status: {
                created: 201,
                ok: 200,
                error: 500,
                rules: 412,
                validation: 422
            }
        }
    };

    $.ajaxSetup({
        headers: {
            'Authorization': app.getCookie('Authorization')
        }
    });
});
