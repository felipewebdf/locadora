@extends('layouts.theme')

@section('content')
<form method="POST" action="javascript:void(0)" id='form-contract'>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control"
                   maxlength="300"
                   required />
        </div>
        <div class="form-group col-md-12">
            <label for="template">Contrato</label>
            <textarea name="template" id="template" class="form-control"
                   required
                   rows="10"
                   ></textarea>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ url('/web/company/contract') }}" class="btn btn-secondary">
                Voltar
            </a>
            <input type="submit" name="contract_submit"
                   class="btn btn-primary"
                   title="Enviar dados do contrato"
                   value="Salvar"/>
        </div>
    </div>
</form>
@endsection
@section('page-js-files')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'template' );
</script>
<script type="text/javascript" src="{{ asset('js/company/contract-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/company/contract-controller.js') }}"></script>
@stop
