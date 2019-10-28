@extends('layouts.theme')

@section('content')
<form method="POST" action="javascript:void(0)" id='form-client'>

    <div class="row">
        <div class="form-group col-md-12">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control"
                   maxlength="300"
                   required />
        </div>
        <div class="form-group col-md-3">
            <label for="document">CPF/CNPJ</label>
            <input type="text" name="document" class="form-control filter-number"
                   maxlength="19"
                   required
                   />
        </div>
        <div class="form-group col-md-3">
            <label for="rg">RG</label>
            <input type="text" name="rg" class="form-control  filter-number"
                   maxlength="19"
                   required
                   />
        </div>
        <div class="form-group col-md-3">
            <label for="cnh">CNH</label>
            <input type="text" name="cnh" class="form-control filter-number"
                   maxlength="9"
                   required
                   />
        </div>
        <div class="form-group col-md-3">
            <label for="cnh_category">Categoria CNH</label>
            <select name="cnh_category" class="form-control" required>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                 <option value="E">E</option>
                <option value="AB">A/B</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="cnh_at">Validade CNH</label>
            <input type="date" name="cnh_at" class="form-control"
                   maxlength="10"
                   required
                   />
        </div>
        <div class="form-group col-md-3">
            <label for="phone_cel">Celular</label>
            <input type="text" name="phone_cel" class="form-control filter-number"
                   maxlength="16"
                   required
                   />
        </div>
        <div class="form-group col-md-3">
            <label for="phone">Telefone</label>
            <input type="text" name="phone" class="form-control filter-number"
                   maxlength="16"
                   />
        </div>
        <div class="form-group col-md-3">
            <label for="cep">CEP</label>
            <input type="text" name="cep" class="form-control filter-number"
                   maxlength="9"
                   required>
        </div>
        <div class="form-group col-md-6">
            <label for="description">Logradouro</label>
            <input type="text" name="description" class="form-control"
                   maxlength="300" required>
        </div>
        <div class="form-group col-md-6">
            <label for="district">Bairro</label>
            <input type="text" name="district" class="form-control"
                   maxlength="200" required>
        </div>
        <div class="form-group col-md-6">
            <label for="complement">Complemento</label>
            <input type="text" name="complement" class="form-control"
                   maxlength="200">
        </div>
        <div class="form-group col-md-3">
            <label for="city">Cidade</label>
            <input type="text" name="city" class="form-control"
                   maxlength="100" required>
        </div>
        <div class="form-group col-md-3">
            <label for="uf">UF</label>
            <input type="hidden"
                   id="defaultUF">
            <select name="uf" class="form-control" required>
                <option value="">UF</option>
                @foreach($ufs as $uf=>$name)
                <option value="{{ $uf }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label for="credcard_name">Bandeira do cartão</label>
            <select name="credcard_name" class="form-control">

                <option>Selecionar bandeira</option>
                <option value="visa">Visa</option>
                <option value="mastercard">Mastercard</option>
                <option value="amex">American express</option>
                <option value="elo">Elo</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="credcard">Número cartão de crédito</label>
            <input type="text" name="credcard" class="form-control filter-number"
                   maxlength="19"
                    />
        </div>
        <div class="form-group col-md-3">
            <label for="credcard_at">Validade</label>
            <input type="text" name="credcard_at" class="form-control"
                   maxlength="5"

                   />
        </div>
        <div class="form-group col-md-3">
            <label for="credcard_cod">Código de segurança</label>
            <input type="text" name="credcard_cod" class="form-control filter-number"
                   maxlength="3"

                   />
        </div>
        <div class="form-group col-md-12">
            <label for="note">Observação</label>
            <textarea name="note" class="form-control"></textarea>
        </div>
    </div>

       <hr>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ url('/web/client') }}" class="btn btn-secondary">
                Voltar
            </a>
            <input type="submit" name="client_submit"
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
