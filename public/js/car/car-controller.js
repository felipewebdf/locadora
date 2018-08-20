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

    $('#brand').change(function() {
        var option = '<option value="">Selecione</option>';
        if (this.value == '') {
            $('#model').html(option);
            return;
        }
        modelService.get(this.value, function(response) {
            $.each(response, function() {
                option += "<option value='"+this.id+"'>"+this.name+"</option>"
            });
            $('#model').html(option);
        });
    })
});