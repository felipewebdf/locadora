@extends('layouts.theme')

@section('content')
<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{url('web/rent/create')}}"
        name="add_rent"
        title="Adicionar contrato"
        class="btn btn-primary right">Adicionar contrato</a>
    </div>
</div>
<br />
<table class="table table-hover">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Veículo</th>
            <th>Tipo</th>
            <th>Valor Diária</th>
            <th>Início</th>
            <th>Fim</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rents as $rent)
        <tr title="Clique na linha para editar esse contrato"
            style='cursor: pointer' itemref="{{ url('/web/rent/update/' . $rent->id) }}"
            class='form_update'>
            <td>{{ $rent->client->name }}</td>
            <td>{{ $rent->car->model->name }} ({{ $rent->car->tag }})</td>
            <td>{{ $rent->type->name }}</td>
            <td>R$ {{ $rent->daily }}</td>
            <td>{{ \Carbon\Carbon::parse($rent->init)->format('d/m/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($rent->end)->format('d/m/Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/rent/rent-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rent/rent-controller.js') }}"></script>
@stop
