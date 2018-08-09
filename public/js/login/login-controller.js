$().ready(function() {
    $('#form-login').submit(function(e) {
        e.preventDefault();
        $.post('/api/login', $(this).serialize(), function(response) {
            app.setCookie('authorization', 'Bearer' + response.data.token, 1);
            window.location.href='/web/company';
        })
        .fail(function(data) {
            app.inputErros(data);
        });
    })
});