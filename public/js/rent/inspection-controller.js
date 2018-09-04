$().ready(function() {
    $('#form-inspection').submit(function(e) {
        e.preventDefault();
        inspectionService.post($(this).serialize(), function() {
            window.location.href = '/web/rent/update/' + $('input[name=rent_id]').val();
        });
    });

    $('.form_update').click(function() {
        window.location.href = $(this).attr('itemref');
    });

    $('#inspection_update').click(function() {
        inspectionService.put(
            $('input[name=id]').val(),
            $('input[name=rent_id]').val(),
            $('#form-inspection').serializeArray()
        );
    });
});