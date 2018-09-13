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
<form method="PUT" action="javascript:void(0)" id='form-devolution'>
    <input type="hidden" name="rent_id" value="{{$rent->id}}" />
    <input type="hidden" name="id" value="{{$devolution->id}}" />
    <div class="row">
        <div class="form-group col-md-4">
            <label for="end_km">Km final</label>
            <input type="text" name="end_km"
                   class="form-control"
                   value="{{$devolution->end_km}}"
                   required />
        </div>
        <div class="form-group col-md-4">
            <label for="gasoline">Combustível</label>
            <select name="gasoline" class="form-control" required >
                @foreach($gasolines as $key=>$gasoline)
                <option value="{{$key}}"
                        {{$devolution->gasoline == $gasoline?'selected':''}}>{{$gasoline}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="washed_out">Lavagem</label>
            <input type="text" name="washed_out"
            value="{{$devolution->washed_out}}"
            class="form-control" required />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="bodywork">Estado do veículo</label>
            <textarea name="bodywork" class="form-control"
         required >{{$devolution->bodywork}}</textarea>
        </div>
        <div class="form-group col-md-12">
            <label for="note">Observações</label>
            <textarea name="note" class="form-control" >{{$devolution->note}}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ url('/web/rent/update/' . $rent->id) }}" class="btn btn-secondary">
                Voltar
            </a>
            <input type="button" name="devolution_update"
                   id="devolution_update"
                   class="btn btn-primary"
                   title="Enviar dados da devolução"
                   value="Enviar"/>
        </div>
    </div>
</form>
<hr>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/rent/devolution-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rent/devolution-controller.js') }}"></script>
@stop
