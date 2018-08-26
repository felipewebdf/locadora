var carService = {
    rulerYear: function(year_factory, year) {
        if (year_factory > year) {
            throw 'Ano de fabricação não pode ser maior que ano';
        }
    },
    rulerCapacity: function(capacity) {
        if (capacity < 1) {
            throw 'A Capacidade do veículo não pode ser menor que 2';
        }
    },
    rulerDoors: function(doors) {
        if (doors < 1) {
            throw 'A quantidade de portas do veículo não pode ser menor que 2';
        }
    },
    post: function (params, callbackSuccess) {
        $('.errors-app').remove();
        try {
            carService.rulerYear($('#year_factory').val(), $("#year").val());
            carService.rulerCapacity($('input[name=capacity]').val());
            carService.rulerDoors($('input[name=door]').val());
            $.post('/api/car', params, function (response, data, headers) {
                if (headers.status == 201) {
                    $('.errors-app').remove();
                    callbackSuccess();
                    app.alert('Carro cadastrado com sucesso', 'success');
                    return;
                }
            }).fail(function (data) {
                if (data.status == 422) {
                    app.alert('Favor verificar as informações', 'warning');
                    return app.inputErros(data);
                }
                if (data.status == 412) {
                    return app.alert(data.responseJSON[0], 'warning');
                }
                app.alert('Falha ao realizar cadastro', 'danger');
            });
        } catch (e) {
            app.alert(e, 'danger');
        }
    },

    put: function (tag, params) {
        try {
            carService.rulerYear($('#year_factory').val(), $("#year").val());
            carService.rulerCapacity($('input[name=capacity]').val());
            carService.rulerDoors($('input[name=door]').val());
            var request = $.ajax({
                url: "/api/car/" + tag,
                method: "PUT",
                data: params
            });

            request.done(function (msg) {
                $('.errors-app').remove();
                app.alert('Carro alterado com sucesso', 'success');
            });

            request.fail(function (jqXHR, textStatus) {
                $('.errors-app').remove();
                if (textStatus == 422) {
                    app.alert('Favor verificar as informações', 'warning');
                    return app.inputErros(jqXHR);
                }
                if (textStatus == 412) {
                    return app.alert(jqXHR.responseJSON[0], 'warning');
                }
                app.alert('Falha ao realizar cadastro', 'danger');
            });
        } catch (e) {
            app.alert(e, 'danger');
        }
    }
};