@extends('layouts.theme')

@section('content')

<form method="POST" action="javascript:void(0)" id='form-company'>
    <div class="row">
        <div class="form-group col-md-8">
            <label for="name">Empresa</label>
            <input type="text" name="name" class="form-control"
                   maxlength="300"
                   value="<?php echo isset($company->name)?$company->name:'' ?>"
                   />
        </div>
        <div class="form-group col-md-3">
            <label for="cnpj">CNPJ</label>
            <input type="text" name="cnpj" class="form-control filter-number"
                   maxlength="14"
                   value="<?php echo isset($company->cnpj)?$company->cnpj:'' ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="cep">CEP</label>
            <input type="text" name="cep" class="form-control filter-number"
                   maxlength="9"
                   value="<?php echo isset($company->id)?$company->address()->first()->cep:''?>">
        </div>
        <div class="form-group col-md-4">
            <label for="description">Logradouro</label>
            <input type="text" name="description" class="form-control"
                   maxlength="300"
                   value="<?php echo isset($company->id)?$company->address()->first()->description:''?>">
        </div>
        <div class="form-group col-md-4">
            <label for="district">Bairro</label>
            <input type="text" name="district" class="form-control"
                   maxlength="200"
                   value="<?php echo isset($company->id)?$company->address()->first()->district:''?>">
        </div>
        <div class="form-group col-md-4">
            <label for="city">Cidade</label>
            <input type="text" name="city" class="form-control"
                   maxlength="100"
                   value="<?php echo isset($company->id)?$company->address()->first()->city:''?>">
        </div>
        <div class="form-group col-md-4">
            <label for="uf">UF</label>
            <input type="hidden"
                   id="defaultUF"
                   value="<?php echo isset($company->id)?$company->address()->first()->uf:''?>">
            <select name="uf" class="form-control">
                <option value="">Selecione</option>
                @foreach ($ufs as $uf=>$name)
                <option value="{{ $uf }}">
                    {{ $name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12 text-right">
            <input type="submit" name="company_submit"
                   class="btn btn-primary"
                   title="Enviar dados da empresa"
                   value="Salvar"/>
        </div>
    </div>
</form>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/company/company-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/company/company-controller.js') }}"></script>
@stop
