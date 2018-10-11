$().ready(function() {

    app = {
        erroAuthentication: function(status) {
            if (status == 401) {
                window.location.href = '/';
            }
        },
        inputErros: function(data) {
            $.each(data.responseJSON.errors, function(k, v) {
                var errors = v;

                if (v.length > 0) {
                    errors = v.join(',');
                }

                $('<span class="text-danger errors-app" id="erro_'+k+'">'+ errors +'</span>')
                        .insertAfter('*[name='+k+']').show();
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
        },
        filter: {
            punctuation: function(data) {
                return data.replace(/[^\d]+/g, '');
            },
            inputNumber: function(params) {
                $.each(params, function() {
                    if ($('input[name=' + this.name + ']').hasClass('filter-number')) {
                        this.value = app.filter.punctuation(this.value);
                    }
                });
                return params;
            },
            cpfCnpj: function(event) {
                try {
                    $(event).unmask();
                } catch (e) {}

                var tamanho = $(event).val().length;

                if(tamanho < 11){
                    $(event).mask("000.000.000-00", {reverse: true});
                } else {
                    $(event).mask("00.000.000/0000-00", {reverse: true});
                }

                // ajustando foco
                var elem = this;
                setTimeout(function(){
                    // mudo a posição do seletor
                    elem.selectionStart = elem.selectionEnd = 10000;
                }, 0);
                // reaplico o valor para mudar o foco
                var currentValue = $(event).val();
                $(event).val('');
                $(event).val(currentValue);
            },
            phone: function(selector) {
                var SPMaskBehavior = function (val) {
                    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                },
                spOptions = {
                    onKeyPress: function(val, e, field, options) {
                        field.mask(SPMaskBehavior.apply({}, arguments), options);
                    }
                };
                $(selector).mask(SPMaskBehavior, spOptions);
            },
            cep: function(selector) {
                $(selector).mask('00000-000', {reverse: true});
            }
        }
    };

    $.ajaxSetup({
        headers: {
            'Authorization': app.getCookie('Authorization')
        }
    });
});
