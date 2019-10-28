$().ready(function() {
    $('#form-client').submit(function(e) {
        e.preventDefault();
        clientService.post($('#form-client').serializeArray(), function() {
            $('#form-client')[0].reset();
        });
    });

    $('.form_update').click(function() {
        window.location.href = $(this).attr('itemref');
    });

    $('#client_update').click(function() {
        clientService.put($('input[name=id]').val(), $('#form-client').serializeArray());
    });


    app.filter.cep('input[name=cep]');
    app.filter.cpfCnpj($('input[name=document]'));
    $("input[name=document]").on('keypress keyup blur focus change',function() {
        app.filter.cpfCnpj(this);
    });

    app.filter.phone('input[name=phone]');
    app.filter.phone('input[name=phone_cel]');

    $('input[name=credcard').mask('0000 0000 0000 0000');
    $('input[name=credcard_at').mask('00/00');
    $('input[name=credcard_cod').mask('000');
    $('input[name=cnh').mask('000000000');
    $('input[name=rg').mask('0000000000');
});