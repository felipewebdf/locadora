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
<form method="PUT" action="javascript:void(0)" id='form-inspection'>
    <input type="hidden" name="rent_id" value="{{$rent->id}}" />
    <input type="hidden" name="id" value="{{$inspection->id}}" />
    <div class="row">
        <div class="form-group col-md-4">
            <label for="init_km">Km inicial</label>
            <input type="text" name="init_km"
                   class="form-control"
                   value="{{$inspection->init_km}}"
                   required />
        </div>
        <div class="form-group col-md-4">
            <label for="gasoline">Combustível</label>
            <input type="text" name="gasoline"
                value="{{$inspection->gasoline}}"
                class="form-control" required />
        </div>
        <div class="form-group col-md-4">
            <label for="washed_out">Lavagem</label>
            <input type="text" name="washed_out"
            value="{{$inspection->washed_out}}"
            class="form-control" required />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="bodywork">Estado do veículo</label>
            <textarea name="bodywork" class="form-control"
         required >{{$inspection->bodywork}}</textarea>
        </div>
        <div class="form-group col-md-12">
            <label for="note">Observações</label>
            <textarea name="note" class="form-control" >{{$inspection->bodywork}}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/web/rent/update/' . $rent->id) }}" class="btn btn-default">
                Voltar
            </a>
            <input type="button" name="inspection_update"
                   id="inspection_update"
                   class="btn btn-primary"
                   title="Enviar dados da vistoria"
                   value="Enviar"/>
        </div>
    </div>
</form>
<hr>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/rent/inspection-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rent/inspection-controller.js') }}"></script>
@stop
