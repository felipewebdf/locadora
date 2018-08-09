@extends('layouts.appadmin')

@section('content')
<div class="header">
    <h1>Dados da empresa</h1>
</div>
<hr>
<form method="POST" action="{{ url('/web/company')}}" id='form-company'>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="name">Empresa</label>
            <input type="text" name="name" class="form-control"
                   value="<?php echo isset($company->name)?$company->name:'' ?>"
                   />
        </div>
        <div class="form-group col-md-4">
            <label for="cnpj">Cnpj</label>
            <input type="text" name="cnpj" class="form-control"
                   value="<?php echo isset($company->cnpj)?$company->cnpj:'' ?>">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="cep">CEP</label>
            <input type="text" name="cep" class="form-control"
                   value="<?php echo isset($company->address()->first()->cep)?$company->address()->first()->cep:''?>">
        </div>
        <div class="form-group col-md-4">
            <label for="description">Logradouro</label>
            <input type="text" name="description" class="form-control"
                   value="<?php echo isset($company->address()->first()->description)?$company->address()->first()->description:''?>">
        </div>
        <div class="form-group col-md-4">
            <label for="district">Bairro</label>
            <input type="text" name="district" class="form-control"
                   value="<?php echo isset($company->address()->first()->district)?$company->address()->first()->district:''?>">
        </div>
        <div class="form-group col-md-4">
            <label for="city">Cidade</label>
            <input type="text" name="city" class="form-control"
                   value="<?php echo isset($company->address()->first()->city)?$company->address()->first()->city:''?>">
        </div>
        <div class="form-group col-md-4">
            <label for="uf">UF</label>
            <input type="hidden"
                   id="defaultUF"
                   value="<?php echo isset($company->address()->first()->uf)?$company->address()->first()->uf:''?>">
            <select name="uf" class="form-control">
                <option value="">UF</option>
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
            </select>
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
