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
                @foreach($ufs as $uf=>$name)
                <option value="{{ $uf }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ url('/web/client') }}" class="btn btn-default">
                Voltar
            </a>
            <input type="submit" name="client_submit"
                   class="btn btn-primary"
                   title="Enviar dados do cliente"
                   value="Enviar"/>
        </div>
    </div>
</form>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/client/client-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/client/client-controller.js') }}"></script>
@stop
