@extends('layouts.appadmin')

@section('content')
<div class="header">
    <h1>Lista de carros</h1>
    <a href="{{url('web/car/create')}}"
            name="add_car"
            title="Adicionar carro"
            class="btn btn-primary right">Adicionar carro</a>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Montadora</th>
            <th>Modelo</th>
            <th>Ano</th>
            <th>Placa</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cars as $car)
        <tr>
            <td>{{ $car->automaker}}</td>
            <td>{{ $car->model }}</td>
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
