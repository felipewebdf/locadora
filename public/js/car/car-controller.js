$().ready(function() {
    $('#form-car').submit(function(e) {
        e.preventDefault();
        carService.post($(this).serialize());
        $(this)[0].reset();
        app.alert('Carro cadastrado com sucesso','success');
    });
});