@extends('layouts.theme')

@section('content')
<form method="POST" action="javascript:void(0)" id='form-client'>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control"
                   maxlength="300"
                   required />
        </div>
        <div class="form-group col-md-3">
            <label for="cnh">CNH</label>
            <input type="text" name="cnh" class="form-control"
                   maxlength="9"
                   required
                   />
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="cep">CEP</label>
            <input type="text" name="cep" class="form-control"
                   maxlength="9">
        </div>
        <div class="form-group col-md-4">
            <label for="description">Logradouro</label>
            <input type="text" name="description" class="form-control"
                   maxlength="300">
        </div>
        <div class="form-group col-md-4">
            <label for="district">Bairro</label>
            <input type="text" name="district" class="form-control"
                   maxlength="200">
        </div>
        <div class="form-group col-md-4">
            <label for="city">Cidade</label>
            <input type="text" name="city" class="form-control"
                   maxlength="100">
        </div>
        <div class="form-group col-md-4">
            <label for="uf">UF</label>
            <input type="hidden"
                   id="defaultUF">
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
            <input type="submit" name="client_submit"
                   class="btn btn-primary"
                   title="Enviar dados do cliente"
                   value="Enviar"/>
        </div>
    </div>
</form>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/car/car-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/car/car-controller.js') }}"></script>
@stop
