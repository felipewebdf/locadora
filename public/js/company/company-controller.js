$().ready(function() {
    if ($('#defaultUF').val()) {
        $('select option[value=' + $('#defaultUF').val() + ']').attr('selected', true);
    }
    $('#form-company').submit(function(e) {
        e.preventDefault();
        companyService.post($(this).serialize());
    });

    $('input[name=cep]').mask('00.000-000', {reverse: true});
    $('input[name=cnpj]').mask('00.000.000/0000-00', {reverse: true});
});