var companyService = {
    post: function(params) {
        $('.errors-app').remove();
        $.post('/api/company', params, function(response, data, headers) {
            if (headers.status == 201) {
                app.alert('Dados da empresa salvos com sucesso', 'success');
            }
        }).fail(function(data) {
            if (data.status == 422) {
                app.alert('Favor verificar as informações', 'warning');
                app.inputErros(data);
            }
        });
    }
};