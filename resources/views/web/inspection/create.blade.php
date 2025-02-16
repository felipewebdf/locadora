@extends('layouts.theme')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Dados do veículo
            </div>
            <div class="card-body">
                Veículo: {{ $rent->car->model->name }} <br />
                Placa: {{ $rent->car->tag }} <br />
            </div>
        </div>
    </div>
</div>
<hr>
<form method="POST" action="javascript:void(0)" id='form-inspection'>
    <input type="hidden" name="rent_id" value="{{$rent->id}}" />
    <div class="row">
        <div class="form-group col-md-4">
            <label for="init_km">Km inicial</label>
            <input type="text" name="init_km" class="form-control" required />
        </div>
        <div class="form-group col-md-4">
            <label for="gasoline">Combustível</label>
            <select name="gasoline" class="form-control" required >
                @foreach($gasolines as $key=>$gasoline)
                <option value="{{$key}}">{{$gasoline}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="washed_out">Lavagem</label>
            <input type="text" name="washed_out" class="form-control" required />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="bodywork">Estado do veículo</label>
            <textarea name="bodywork" class="form-control" required > </textarea>
        </div>
        <div class="form-group col-md-12">
            <label for="note">Observações</label>
            <textarea name="note" class="form-control" ></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ url('/web/rent/update/' . $rent->id) }}" class="btn btn-secondary">
                Voltar
            </a>
            <input type="submit" name="inspection_submit"
                   class="btn btn-primary"
                   title="Enviar dados da vistoria"
                   value="Salvar"/>
        </div>
    </div>
</form>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/rent/inspection-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rent/inspection-controller.js') }}"></script>
@stop
