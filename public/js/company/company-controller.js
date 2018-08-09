$().ready(function() {
    $('#form-company').submit(function(e) {
        e.preventDefault();
        companyService.post($(this).serialize());
    });
});