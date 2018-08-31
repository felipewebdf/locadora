$().ready(function() {
    $('#form-client').submit(function(e) {
        e.preventDefault();
        clientService.post($(this).serialize(), function() {
            $('#form-client')[0].reset();
        });
    });

    $('.form_update').click(function() {
        window.location.href = $(this).attr('itemref');
    });

    $('#client_update').click(function() {
        clientService.put($('input[name=id]').val(), $('#form-client').serialize());
    });
});