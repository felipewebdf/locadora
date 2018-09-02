$().ready(function() {
    $('#form-inspection').submit(function(e) {
        e.preventDefault();
        inspectionService.post($(this).serialize(), function() {
            $('#form-inspection')[0].reset();
        });
    });

    $('.form_update').click(function() {
        window.location.href = $(this).attr('itemref');
    });

    $('#inspection_update').click(function() {
        inspectionService.put($('input[name=id]').val(), $('#form-inspection').serialize());
    });
});