var companyService = {
    post: function(params) {
        $.post('/api/company', params, function(response) {

        }).fail(function(data) {
            if (data.status == 422) {
                $.each(data.responseJSON.errors, function(k, v) {
                    var errors = v;

                    if (v.length > 1) {
                        errors = v.join(',');
                    }

                    $('<span class="text-danger" id="erro_'+k+'">'+v+'</span>').insertAfter('input[name='+k+']');
                });
            }
        });
    }
};