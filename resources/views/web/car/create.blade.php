@extends('layouts.appadmin')

@section('content')
<div class="header">
    <h1>Adicionar carro</h1>
</div>
<hr>
<form method="POST" action="javascript:void(0)" id='form-car'>
    <div class="row">
<!--        <div class="form-group col-md-3">
            <label for="automaker">Montadora</label>
            <input type="text" name="automaker" class="form-control"
                   maxlength="100"
                   value="<?php //echo isset($car->model)?$car->automaker:'' ?>"
                   />
        </div>-->
        <div class="form-group col-md-3">
            <label for="model">Modelo</label>
            <input type="text" name="model" class="form-control"
                   maxlength="200"
                   value="<?php echo isset($car->model_id)?$car->model_id:'' ?>">
        </div>
        <div class="form-group col-md-2">
            <label for="power">Potência</label>
            <input type="text" name="power" class="form-control"
                   maxlength="4"
                   value="<?php echo isset($car->power)?$car->power:'' ?>">
        </div>
        <div class="form-group col-md-2">
            <label for="year_factory">Fabricação</label>
            <input type="text" name="year_factory" class="form-control"
                   maxlength="4"
                   value="<?php echo isset($car->year_factory)?$car->year_factory:'' ?>">
        </div>
        <div class="form-group col-md-2">
            <label for="year">Ano</label>
            <input type="text" name="year" class="form-control"
                   maxlength="4"
                   value="<?php echo isset($car->year)?$car->year:'' ?>">
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
            <input type="submit" name="car_submit"
                   class="btn btn-primary"
                   title="Enviar dados do veículo"
                   value="Enviar"/>
        </div>
    </div>
</form>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/car/car-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/car/car-controller.js') }}"></script>
@stop
