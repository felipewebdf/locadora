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
                app.inputErros(data);
            }
        });
    }
};