$().ready(function() {
    $('#form-login').submit(function(e) {
        e.preventDefault();
        loginService.authenticate($(this).serialize());
    });
});