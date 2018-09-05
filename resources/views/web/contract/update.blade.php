@extends('layouts.theme')

@section('content')
<form method="PUT" action="javascript:void(0)" id='form-contract'>
    <input type="hidden" name="id"
                   value="{{$contract->id}}"
                   required />
    <div class="row">
        <div class="form-group col-md-12">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control"
                   maxlength="300"
                   value="{{$contract->name}}"
                   required />
        </div>
        <div class="form-group col-md-12">
            <label for="template">Contrato</label>
            <textarea name="template" id="template" class="form-control"
                   required
                   rows="10"
                   >{{$contract->template}}</textarea>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ url('/web/company/contract') }}" class="btn btn-default">
                Voltar
            </a>
            <input type="button" id="contract_update"
                   class="btn btn-primary"
                   title="Enviar dados do contrato"
                   value="Enviar"/>
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
