@extends('layouts.theme')

@section('content')
<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{url('web/car/create')}}"
        name="add_car"
        title="Adicionar carro"
        class="btn btn-primary right">Adicionar carro</a>
    </div>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Montadora</th>
            <th>Modelo</th>
            <th>Fabricação/Ano</th>
            <th>Placa</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cars as $car)
        <tr title="Clique na linha para editar esse veículo"
            style='cursor: pointer' itemref="{{ url('/web/car/update/' . $car->tag) }}"
            class='form_update'>
            <td>{{ $car->model->brand->name }}</td>
            <td>{{ $car->model->name }}</td>
            <td>{{ $car->year_factory }} / {{ $car->year }}</td>
            <td>{{ $car->tag }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/car/car-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/car/car-controller.js') }}"></script>
@stop
