$().ready(function() {
    $('#form-car').submit(function(e) {
        e.preventDefault();
        carService.post($(this).serialize());
        $(this)[0].reset();
    });

    $('.form_update').click(function() {
        window.location.href = $(this).attr('itemref');
    });

    $('#car_update').click(function() {
        carService.put($('input[name=tag]').val(), $('#form-car').serialize());
    });
});