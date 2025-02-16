var clientService = {
    post: function (params, callbackSuccess) {
        $('.errors-app').remove();
        try {
            params = app.filter.inputNumber(params);
            $.post('/api/client', params, function (response, data, headers) {
                if (headers.status == app.http.status.created) {
                    $('.errors-app').remove();
                    callbackSuccess();
                    app.alert('Cliente cadastrado com sucesso', 'success');
                    return;
                }
            }).fail(function (data) {
                app.erroAuthentication(data.status);
                if (data.status == app.http.status.validation) {
                    app.alert('Favor verificar as informações', 'warning');
                    return app.inputErros(data);
                }
                if (data.status == app.http.status.rules) {
                    return app.alert(data.responseJSON[0], 'warning');
                }
                app.alert('Falha ao realizar cadastro', 'danger');
            });
        } catch (e) {
            app.alert(e, 'danger');
        }
    },

    put: function (id, params) {
        params = app.filter.inputNumber(params);
        try {
            var request = $.ajax({
                url: "/api/client/" + id,
                method: "PUT",
                data: params
            });

            request.done(function (msg) {
                $('.errors-app').remove();
                app.alert('Cliente alterado com sucesso', 'success');
            });

            request.fail(function (jqXHR, textStatus) {
                app.erroAuthentication(textStatus);
                $('.errors-app').remove();
                if (jqXHR.status == 422 || textStatus == 422) {
                    app.alert('Favor verificar as informações', 'warning');
                    return app.inputErros(jqXHR);
                }
                if (textStatus == 412) {
                    return app.alert(jqXHR.responseJSON[0], 'warning');
                }
                app.alert('Falha ao realizar cadastro', 'danger');
            });
        } catch (e) {
            app.alert(e, 'danger');
        }
    }
};