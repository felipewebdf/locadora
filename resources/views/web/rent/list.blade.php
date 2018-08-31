@extends('layouts.theme')

@section('content')
<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{url('web/rent/create')}}"
        name="add_rent"
        title="Adicionar locação"
        class="btn btn-primary right">Adicionar locação</a>
    </div>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Veículo</th>
            <th>Tipo</th>
            <th>Diária</th>
            <th>Início</th>
            <th>Fim</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rents as $rent)
        <tr title="Clique na linha para editar esse locação"
            style='cursor: pointer' itemref="{{ url('/web/rent/update/' . $rent->id) }}"
            class='form_update'>
            <td>{{ $rent->client->name }}</td>
            <td>{{ $rent->car->model->name }}</td>
            <td>{{ $rent->type_rent->name }}</td>
            <td>{{ $rent->daily }}</td>
            <td>{{ $rent->init }}</td>
            <td>{{ $rent->end }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('page-js-files')
<!--<script type="text/javascript" src="{{ asset('js/rent/rent-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rent/rent-controller.js') }}"></script>-->
@stop
