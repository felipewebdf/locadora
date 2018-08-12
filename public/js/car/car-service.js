var carService = {
    post: function (params) {
        $('.errors-app').remove();
        $.post('/api/car', params, function (response, data, headers) {
            if (headers.status == 201) {
                $('.errors-app').remove();
                app.alert('Carro cadastrado com sucesso', 'success');
            }
        }).fail(function (data) {
            if (data.status == 422) {
                app.alert('Favor verificar as informações', 'warning');
                return app.inputErros(data);
            }
            if (data.status == 412) {
                return app.alert(data.responseJSON[0], 'warning');
            }
            app.alert('Falha ao realizar cadastro', 'danger');
        });
    },

    put: function (tag, params) {
        var request = $.ajax({
            url: "/api/car/" + tag,
            method: "PUT",
            data: params
        });

        request.done(function (msg) {
            $('.errors-app').remove();
            app.alert('Carro alterado com sucesso', 'success');
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
    }
};