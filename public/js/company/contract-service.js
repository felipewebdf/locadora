var contractService = {
    post: function(params, callback) {
        $('.errors-app').remove();
        $.post('/api/company/contract', params, function(response, data, headers) {
            callback(response, headers);
        }).fail(function(data) {
            app.erroAuthentication(data.status);
            if (data.status == 422) {
                app.alert('Favor verificar as informações', 'warning');
                app.inputErros(data);
            }
        });
    },
    put: function (id, params) {
        try {
            var request = $.ajax({
                url: "/api/company/contract/" + id,
                method: "PUT",
                data: params
            });

            request.done(function (msg) {
                $('.errors-app').remove();
                app.alert('Contrato alterado com sucesso', 'success');
            });

            request.fail(function (jqXHR, textStatus) {
                app.erroAuthentication(textStatus);
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