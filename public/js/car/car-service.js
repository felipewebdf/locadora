var carService = {
    post: function(params) {
        $.post('/api/car', params, function(response, data, headers) {
            if (headers.status == 201) {
                $('.errors-app').remove();
                app.alert('Carro cadastrado com sucesso', 'success');
            }
        }).fail(function(data) {
            if (data.status == 422) {
                app.alert('Favor verificar as informações', 'warning');
                return app.inputErros(data);
            }
            if (data.status == 412) {
                console.log(data);
                return app.alert(data.responseJSON[0], 'warning');
            }
            app.alert('Falha ao realizar cadastro', 'danger');
        });
    }
};