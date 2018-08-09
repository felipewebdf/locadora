var companyService = {
    post: function(params) {
        $.post('/api/company', params, function(response) {

        }).fail(function(data) {
            if (data.status == 422) {
                app.inputErros(data);
            }
        });
    }
};