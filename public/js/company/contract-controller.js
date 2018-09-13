$().ready(function() {
    $('#form-contract').submit(function(e) {
        e.preventDefault();
        $('#template').val(CKEDITOR.instances.template.getData());
        contractService.post($(this).serializeArray(), function(response, headers) {
            if (headers.status == app.http.status.created) {
                app.alert('Dados do contrato salvos com sucesso', 'success');
                window.location.href='/web/company/contract/update/' + response.id;
            }
        });
    });

    $('.form_update').click(function() {
        window.location.href = $(this).attr('itemref');
    });

    $('#contract_update').click(function() {
        $('#template').val(CKEDITOR.instances.template.getData());
        console.log($('#form-contract').serialize());
        contractService.put($('input[name=id]').val(), $('#form-contract').serialize());
    });
});