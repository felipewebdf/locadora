var modelService = {
    get: function(brand_id, callback) {
        $.get('/api/car/model', {brand_id: brand_id}, function(response) {
            callback(response);
        });
    }
};