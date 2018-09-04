var rentService = {
    post: function (params, callbackSuccess) {
        $('.errors-app').remove();
        try {
            $.post('/api/rent', params, function (response, data, headers) {
                if (headers.status == app.http.status.created) {
                    $('.errors-app').remove();
                    callbackSuccess(response.id);
                    app.alert('Locação cadastrada com sucesso', 'success');
                    return;
                }
            }).fail(function (data) {
                if (data.status == app.http.status.validation) {
                    app.alert('Favor verificar as informações', 'warning');
                    return app.inputErros(data);
                }
                if (data.status == app.http.status.rules) {
                    return app.alert(data.responseJSON[0], 'warning');
                }
                app.alert('Falha ao realizar cadastro', 'danger');
            });
        } catch (e) {
            app.alert(e, 'danger');
        }
    },

    put: function (id, params) {
        try {
            var request = $.ajax({
                url: "/api/rent/" + id,
                method: "PUT",
                data: params
            });

            request.done(function (msg) {
                $('.errors-app').remove();
                app.alert('Locação alterada com sucesso', 'success');
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
    },

    totalKm: function(km_day, init, end) {
        var dtInit = new Date(init);
        var dtEnd = new Date(end);
        var timeDiff = Math.abs(dtEnd.getTime() - dtInit.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        return diffDays * km_day;
    }
};