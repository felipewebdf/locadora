$().ready(function() {
    $('#form-car').submit(function(e) {
        e.preventDefault();
        carService.post($(this).serialize());
    });
});