$().ready(function() {
    $('#form-devolution').submit(function(e) {
        e.preventDefault();
        devolutionService.post($(this).serialize(), function() {
            window.location.href = '/web/rent/update/' + $('input[name=rent_id]').val();
        });
    });

    $('.form_update').click(function() {
        window.location.href = $(this).attr('itemref');
    });

    $('#devolution_update').click(function() {
        devolutionService.put(
            $('input[name=id]').val(),
            $('input[name=rent_id]').val(),
            $('#form-devolution').serializeArray()
        );
    });
});