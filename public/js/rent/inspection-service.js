var inspectionService = {
    post: function (params, callbackSuccess) {
        $('.errors-app').remove();
        try {
            $.post('/api/inspection', params, function (response, data, headers) {
                if (headers.status == app.http.status.created) {
                    $('.errors-app').remove();
                    callbackSuccess();
                    app.alert('Vistoria cadastrada com sucesso', 'success');
                    return;
                }
            }).fail(function (data) {
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
        try {
            var request = $.ajax({
                url: "/api/inspection/" + id,
                method: "PUT",
                data: params
            });

            request.done(function (msg) {
                $('.errors-app').remove();
                app.alert('Vistoria alterada com sucesso', 'success');
            });

            request.fail(function (jqXHR, textStatus) {
                $('.errors-app').remove();
                if (textStatus == 422) {
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