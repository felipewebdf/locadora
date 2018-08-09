var companyService = {
    post: function(params) {
        $.post('/api/company', params, function(response, data, headers) {
            if (headers.status == 201) {
                $('.errors-app').remove();
                app.alert('Empresa cadastrada com sucesso', 'success');
            }
        }).fail(function(data) {
            if (data.status == 422) {
                app.alert('Favor verificar as informações', 'warning');
                app.inputErros(data);
            }
        });
    }
};