$().ready(function() {
    $('#form-rent').submit(function(e) {
        e.preventDefault();
        rentService.post($(this).serialize(), function() {
            $('#form-rent')[0].reset();
        });
    });

    $('.form_update').click(function() {
        window.location.href = $(this).attr('itemref');
    });

    $('#rent_update').click(function() {
        rentService.put($('input[name=id]').val(), $('#form-rent').serialize());
    });
});