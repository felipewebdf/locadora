@extends('layouts.theme')

@section('content')
<form method="POST" action="javascript:void(0)" id='form-rent'>
    <div class="row">
        <div class="form-group col-md-3">
            <label for="client_id">Cliente</label>
            <select name="client_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="car_id">Veículo</label>
            <select name="car_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($cars as $car)
                <option value="{{ $car->id }}">{{ $car->model->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="type_rent_id">Tipo de locação</label>
            <select name="type_rent_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($types_rents as $type_rent)
                <option value="{{ $type_rent->id }}">{{ $type_rent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="daily">Valor Diária</label>
            <input type="text" name="daily" class="form-control" required />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label for="km_day">Km por dia</label>
            <input type="numeric" name="km_day" class="form-control" required />
        </div>
        <div class="form-group col-md-3">
            <label for="init">Início</label>
            <input type="datetime-local" name="init" class="form-control" required />
        </div>
        <div class="form-group col-md-3">
            <label for="end">Fim</label>
            <input type="datetime-local" name="end" class="form-control" />
        </div>
        <div class="form-group col-md-3">
            <label for="total_km">Total km</label>
            <input type="numeric" id="total_km" class="form-control" readonly="readonly" />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="comment">Observação</label>
            <textarea name="comment" class="form-control"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ url('/web/rent') }}" class="btn btn-default">
                Voltar
            </a>
            <input type="submit" name="rent_submit"
                   class="btn btn-primary"
                   title="Enviar dados da locação"
                   value="Enviar"/>
        </div>
    </div>
</form>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/rent/rent-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rent/rent-controller.js') }}"></script>
@stop
