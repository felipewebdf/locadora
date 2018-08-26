@extends('layouts.appadmin')

@section('content')
<div class="header">
    <h1>Alterar carro</h1>
</div>
<hr>
<form method="PUT" action="javascript:void(0)" id='form-car'>
    <div class="row">
        <div class="form-group col-md-3">
            <label for="brand">Montadora</label>
            <select id="brand" name="brand" class="form-control"
                   >
                <option value="">Selecione</option>
                @foreach ($brands as $brand)
                <option value="{{ $brand->id }}"
                        {{ $brand->id == $car->model->brand->id ? 'selected' : ''}}>
                    {{ $brand->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="model">Modelo</label>
            <select id="model" name="model" class="form-control">
                <option value="">Selecione</option>
                @foreach ($models as $model)
                <option value="{{ $model->id }}"
                        {{ $model->id == $car->model->id ? 'selected' : ''}}>
                    {{ $model->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="power">Potência</label>
            <input type="text" name="power" class="form-control"
                   maxlength="4"
                   value="<?php echo isset($car->power)?$car->power:'' ?>">
        </div>
        <div class="form-group col-md-2">
            <label for="year_factory">Fabricação</label>
            <select id="year_factory" name="year_factory" class="form-control"
                   required >
                <option value="">Selecione</option>
                @foreach ($years as $year)
                <option value="{{ $year }}" <?php echo $car->year_factory==$year ? 'selected':'' ?>>
                    {{ $year }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="year">Ano</label>
            <select id="year" name="year" class="form-control"
                   required >
                <option value="">Selecione</option>
                @foreach ($years as $year)
                <option value="{{ $year }}" <?php echo $car->year==$year ? 'selected':'' ?>>
                    {{ $year }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="form-group col-md-3">
            <label for="tag">Placa</label>
            <input type="text" name="tag" class="form-control"
                   maxlength="9"
                   value="<?php echo isset($car->tag)?$car->tag:'' ?>"
                   />
        </div>
        <div class="form-group col-md-3">
            <label for="renavan">Renavan</label>
            <input type="text" name="renavan" class="form-control"
                   maxlength="60"
                   value="<?php echo isset($car->renavan)?$car->renavan:'' ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="door">Portas</label>
            <input type="number" name="door" class="form-control"
                   maxlength="2"
                   value="<?php echo isset($car->door)?$car->door:'' ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="capacity">Capacidade</label>
            <input type="number" name="capacity" class="form-control"
                   maxlength="4"
                   value="<?php echo isset($car->capacity)?$car->capacity:'' ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="button" id="car_update"
                   class="btn btn-primary"
                   title="Enviar dados do veículo"
                   value="Enviar"/>
        </div>
    </div>
</form>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/car/car-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/car/model-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/car/car-controller.js') }}"></script>
@stop
