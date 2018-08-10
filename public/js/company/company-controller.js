$().ready(function() {
    if ($('#defaultUF').val()) {
        $('select option[value=' + $('#defaultUF').val() + ']').attr('selected', true);
    }
    $('#form-company').submit(function(e) {
        e.preventDefault();
        companyService.post($(this).serialize());
    });
});