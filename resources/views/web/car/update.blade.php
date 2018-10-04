@extends('layouts.theme')

@section('content')
<form method="PUT" action="javascript:void(0)" id='form-car'>
   <hr>
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
            <select id="power" name="power" class="form-control"
                   required >
                <option value="">Selecione</option>
                @foreach ($powers as $power)
                <option value="{{ $power }}"
                        <?php echo $car->power==$power ? 'selected':'' ?>>
                    {{ $power }}
                </option>
                @endforeach
            </select>
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

    <div class="row">
        <div class="form-group col-md-3">
            <label for="tag">Placa</label>
            <input type="text" name="tag" class="form-control"
                   maxlength="9"
                   value="<?php echo $car->tag ?>"
                   />
        </div>
        <div class="form-group col-md-3">
            <label for="chassi">Chassi</label>
            <input type="text" name="chassi" class="form-control"
                   maxlength="150"
                   value="<?php echo $car->chassi ?>"
                   />
        </div>
        <div class="form-group col-md-3">
            <label for="type_fuel">Tipo de combustível</label>
            <select name="type_fuel" class="form-control"
                   required
                   >
                @foreach($arrFuel as $keyFuel=>$fuel)
                <option value="{{$keyFuel}}"
                        {{$car->type_fuel == $keyFuel ? 'selected' : ''}}>{{$fuel}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="renavan">Renavan</label>
            <input type="number" name="renavan" class="form-control"
                   maxlength="60"
                   value="<?php echo $car->renavan ?>">
        </div>
    </div>
   <div class='row'>
       <div class="form-group col-md-2">
            <label for="door">Portas</label>
            <input type="number" name="door" class="form-control"
                   maxlength="2"
                   value="<?php echo $car->door ?>">
        </div>
        <div class="form-group col-md-2">
            <label for="capacity">Capacidade</label>
            <input type="number" name="capacity" class="form-control"
                   maxlength="4"
                   value="<?php echo $car->capacity ?>">
        </div>
       <div class="form-group col-md-2">
            <label for="color">Cor</label>
            <select name='color' class='form-control' required>
                @foreach($colors as $keyColor=>$color)
                <option value='{{$keyColor}}'
                        {{$car->color == $keyColor ? 'selected' : ''}}>{{$color}}</option>
                @endforeach
            </select>
        </div>
   </div>
   <hr>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ url('/web/car') }}" class="btn btn-secondary">
                Voltar
            </a>
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
