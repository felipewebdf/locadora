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

    $('input[name=end]').change(function() {
        var init = $('input[name=init]').val();
        var km_day = $('input[name=km_day]').val();
        var end = $(this).val();

        if (init != '' && km_day != '') {
            var totalKm = rentService.totalKm(km_day, init, end);
            $('#total_km').val(totalKm);
        }
    });

    $('input[name=init]').change(function() {
        var end = $('input[name=init]').val();
        var km_day = $('input[name=km_day]').val();
        var init = $(this).val();

        if (end != '' && km_day != '') {
            var totalKm = rentService.totalKm(km_day, init, end);
            $('#total_km').val(totalKm);
        }
    });

    $('input[name=km_day]').change(function() {
        var init = $('input[name=init]').val();
        var end = $('input[name=end]').val();
        var km_day = $(this).val();

        if (end != '' && init != '') {
            var totalKm = rentService.totalKm(km_day, init, end);
            $('#total_km').val(totalKm);
        }
    });
});