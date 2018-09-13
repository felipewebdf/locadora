var loginService = {
    authenticate: function(params) {
        $.post('/api/login', params, function(response) {
            app.setCookie('Authorization', 'Bearer ' + response.data.token);
            window.location.href='/web/company';
        })
        .fail(function(data) {
            app.erroAuthentication(data.status);
            app.inputErros(data);
        });
    }
};


