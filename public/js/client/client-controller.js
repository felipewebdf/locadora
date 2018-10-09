$().ready(function() {
    $('#form-client').submit(function(e) {
        e.preventDefault();
        clientService.post($(this).serialize(), function() {
            $('#form-client')[0].reset();
        });
    });

    $('.form_update').click(function() {
        window.location.href = $(this).attr('itemref');
    });

    $('#client_update').click(function() {
        clientService.put($('input[name=id]').val(), $('#form-client').serialize());
    });

    $('input[name=cep]').mask('00000-000');
    $("input[name=document]").on('keypress keyup blur focus',function(){
        try {
            $("input[name=document]").unmask();
        } catch (e) {}

        var tamanho = $("input[name=document]").val().length;

        if(tamanho < 11){
            $("input[name=document]").mask("000.000.000-00");
        } else if(tamanho >= 11){
            $("input[name=document]").mask("00.000.000/0000-00");
        }

        // ajustando foco
        var elem = this;
        setTimeout(function(){
            // mudo a posição do seletor
            elem.selectionStart = elem.selectionEnd = 10000;
        }, 0);
        // reaplico o valor para mudar o foco
        var currentValue = $(this).val();
        $(this).val('');
        $(this).val(currentValue);
    });
});