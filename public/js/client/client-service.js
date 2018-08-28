var clientService = {
    post: function (params, callbackSuccess) {
        $('.errors-app').remove();
        try {
            $.post('/api/client', params, function (response, data, headers) {
                if (headers.status == 201) {
                    $('.errors-app').remove();
                    callbackSuccess();
                    app.alert('Cliente cadastrado com sucesso', 'success');
                    return;
                }
            }).fail(function (data) {
                if (data.status == 422) {
                    app.alert('Favor as informações', 'warning');
                    return app.inputErros(data);
                }
                if (data.status == 412) {
                    return app.alert(data.responseJSON[0], 'warning');
                }
                app.alert('Falha ao realizar cadastro', 'danger');
            });
        } catch (e) {
            app.alert(e, 'danger');
        }
    },

    put: function (id, params) {
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
                $('.errors-app').remove();
                if (textStatus == 422) {
                    app.alert('Favor as informações', 'warning');
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