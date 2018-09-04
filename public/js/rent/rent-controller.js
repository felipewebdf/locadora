$().ready(function() {
    $('#form-rent').submit(function(e) {
        e.preventDefault();
        rentService.post($(this).serialize(), function(rent_id) {
            window.location.href = '/web/rent/update/'+rent_id;
        });
    });

    $('.form_update').click(function() {
        window.location.href = $(this).attr('itemref');
    });

    $('#rent_update').click(function() {
        rentService.put($('input[name=id]').val(), $('#form-rent').serialize());
    });
});