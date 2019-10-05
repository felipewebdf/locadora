@extends('layouts.theme')

@section('content')

<form method="POST" action="javascript:void(0)" id='form-company'>
    <div class="row">
        <div class="form-group col-md-8">
            <label for="name">Empresa</label>
            <input type="text" name="name" class="form-control"
                   maxlength="300"
                   required
                   value="<?php echo isset($company->name)?$company->name:'' ?>"
                   />
        </div>
        <div class="form-group col-md-3">
            <label for="cnpj">CNPJ</label>
            <input type="text" name="cnpj" class="form-control filter-number"
                   maxlength="14"
                   required
                   value="<?php echo isset($company->cnpj)?$company->cnpj:'' ?>">
        </div>
    </div>
    <div class="row">
        <input type="file" name="upload" />
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12 text-right">
            <input type="submit" name="company_upload"
                   class="btn btn-primary"
                   title="Enviar imagem da empresa"
                   value="Salvar"/>
        </div>
    </div>
</form>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/company/company-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/company/company-controller.js') }}"></script>
@stop
