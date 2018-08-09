@extends('layouts.appadmin')

@section('content')
<div class="header">
    <h1>Dados da empresa</h1>
</div>
<hr>
<form class="form-group" method="POST" action="{{ url('/web/company')}}" id='form-company'>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="name">Empresa</label>
            <input type="text" name="name" class="input-group">
        </div>
        <div class="form-group col-md-4">
            <label for="cnpj">Cnpj</label>
            <input type="text" name="cnpj" class="input-group">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="cep">CEP</label>
            <input type="text" name="cep" class="input-group">
        </div>
        <div class="form-group col-md-4">
            <label for="description">Logradouro</label>
            <input type="text" name="description" class="input-group">
        </div>
        <div class="form-group col-md-4">
            <label for="district">Bairro</label>
            <input type="text" name="district" class="input-group">
        </div>
        <div class="form-group col-md-4">
            <label for="city">Cidade</label>
            <input type="text" name="city" class="input-group">
        </div>
        <div class="form-group col-md-4">
            <label for="uf">UF</label>
            <input type="text" name="uf" class="input-group">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="submit" name="company_submit"
                   class="btn btn-primary"
                   title="Enviar dados da empresa"
                   value="enviar"/>
        </div>
    </div>
</form>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/company/company-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/company/company-controller.js') }}"></script>
@stop
