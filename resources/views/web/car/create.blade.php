@extends('layouts.theme')

@section('content')
<form method="POST" action="javascript:void(0)" id='form-car'>
    <hr>
    <div class="row">
        <div class="form-group col-md-3">
            <label for="automaker">Montadora</label>
            <select name="brand" id="brand" class="form-control" required>
                <option value="">Selecione</option>
                @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">
                    {{ $brand->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="model">Modelo</label>
            <select id="model" name="model" class="form-control" required></select>
        </div>
        <div class="form-group col-md-2">
            <label for="power">Potência</label>
            <select id="power" name="power" class="form-control"
                   required >
                <option value="">Selecione</option>
                @foreach ($powers as $power)
                <option value="{{ $power }}">
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
                <option value="{{ $year }}">
                    {{ $year }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="year">Ano</label>
            <select id="year"  name="year" class="form-control"
                   required >
                <option value="">Selecione</option>
                @foreach ($years as $year)
                <option value="{{ $year }}">
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
                   required
                   />
        </div>
        <div class="form-group col-md-3">
            <label for="chassi">Chassi</label>
            <input type="text" name="chassi" class="form-control"
                   maxlength="150"
                   required
                   />
        </div>
        <div class="form-group col-md-3">
            <label for="type_fuel">Tipo de combustível</label>
            <select name="type_fuel" class="form-control"
                   required
                   >
                @foreach($arrFuel as $keyFuel=>$fuel)
                <option value="{{$keyFuel}}">{{$fuel}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="renavan">Renavan</label>
            <input type="number" name="renavan" class="form-control"
                   maxlength="60">
        </div>
    </div>
    <div class='row'>
        <div class="form-group col-md-2">
            <label for="door">Portas</label>
            <input type="number" name="door" class="form-control"
                   maxlength="2"
                   required />
        </div>
        <div class="form-group col-md-2">
            <label for="capacity">Capacidade</label>
            <input type="number" name="capacity" class="form-control"
                   maxlength="4"
                   required />
        </div>
        <div class="form-group col-md-2">
            <label for="color">Cor</label>
            <select name='color' class='form-control' required>
                @foreach($colors as $keyColor=>$color)
                <option value='{{$keyColor}}'>{{$color}}</option>
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
            <input type="submit" name="car_submit"
                   class="btn btn-primary"
                   title="Enviar dados do veículo"
                   value="Salvar"/>
        </div>
    </div>
</form>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/car/car-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/car/model-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/car/car-controller.js') }}"></script>
@stop
