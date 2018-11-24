@extends('layouts.theme')

@section('content')
<form method="PUT" action="javascript:void(0)" id='form-client'>
     <input type="hidden" name="id"
                   value="<?php echo $client->id ?>"
                   required />
    <div class="row">
        <div class="form-group col-md-6">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control"
                   maxlength="300"
                   value="<?php echo $client->name ?>"
                   required />
        </div>
        <div class="form-group col-md-3">
            <label for="document">CPF/CNPJ</label>
            <input type="text" name="document" class="form-control filter-number"
                   value="<?php echo $client->document ?>"
                   maxlength="14"
                   required
                   />
        </div>
        <div class="form-group col-md-3">
            <label for="phone">Telefone</label>
            <input type="text" name="phone" class="form-control filter-number"
                   value="<?php echo $client->phone ?>"
                   maxlength="50"
                   required
                   />
        </div>
    </div>
     <div class="row">
        <div class="form-group col-md-3">
            <label for="credcard">Cartão de crédito</label>
            <input type="text" name="credcard" class="form-control filter-number"
                   value="<?php echo $client->credcard ?>"
                   maxlength="150"
                   required />
        </div>
        <div class="form-group col-md-3">
            <label for="credcard_at">Validade</label>
            <input type="text" name="credcard_at" class="form-control"
                   value="<?php echo $client->credcard_at ?>"
                   maxlength="5"
                   required
                   />
        </div>
         <div class="form-group col-md-3">
            <label for="cnh">CNH</label>
            <input type="text" name="cnh" class="form-control filter-number"
                   value="<?php echo $client->cnh ?>"
                   maxlength="9"
                   required
                   />
        </div>
         <div class="form-group col-md-3">
            <label for="cep">CEP</label>
            <input type="text" name="cep" class="form-control filter-number"
                   value="<?php echo $client->address->cep ?>"
                   maxlength="9">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label for="description">Logradouro</label>
            <input type="text" name="description" class="form-control"
                   value="<?php echo $client->address->description ?>"
                   maxlength="300">
        </div>
        <div class="form-group col-md-3">
            <label for="district">Bairro</label>
            <input type="text" name="district" class="form-control"
                   value="<?php echo $client->address->district ?>"
                   maxlength="200">
        </div>
        <div class="form-group col-md-3">
            <label for="city">Cidade</label>
            <input type="text" name="city" class="form-control"
                   value="<?php echo $client->address->city ?>"
                   maxlength="100">
        </div>
        <div class="form-group col-md-3">
            <label for="uf">UF</label>
            <input type="hidden"
                   id="defaultUF">
            <select name="uf" class="form-control">
                <option value="">UF</option>
                @foreach($ufs as $uf=>$name)
                <option value="{{ $uf }}"
                        {{ $client->address->uf == $uf ? 'selected' : ''}}>
                    {{ $name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ url('/web/client') }}" class="btn btn-secondary">
                Voltar
            </a>
            <input type="button" id="client_update"
                   class="btn btn-primary"
                   title="Enviar dados do cliente"
                   value="Salvar"/>
        </div>
    </div>
</form>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/client/client-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/client/client-controller.js') }}"></script>
@stop
