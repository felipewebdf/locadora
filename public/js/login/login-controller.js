$().ready(function() {
    $('#form-login').submit(function(e) {
        e.preventDefault();
        $.post('/api/login', $(this).serialize(), function(response) {
            app.setCookie('Authorization', 'Bearer ' + response.data.token);
            window.location.href='/web/company';
        })
        .fail(function(data) {
            app.inputErros(data);
        });
    })
});