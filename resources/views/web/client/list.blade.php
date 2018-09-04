@extends('layouts.theme')

@section('content')
<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{url('web/client/create')}}"
        name="add_client"
        title="Adicionar cliente"
        class="btn btn-primary right">Adicionar cliente</a>
    </div>
</div>
<br />
<table class="table table-hover">
    <thead>
        <tr>
            <th>Nome</th>
            <th>CNH</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $client)
        <tr title="Clique na linha para editar esse cliente"
            style='cursor: pointer' itemref="{{ url('/web/client/update/' . $client->id) }}"
            class='form_update'>
            <td>{{ $client->name }}</td>
            <td>{{ $client->cnh }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/client/client-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/client/client-controller.js') }}"></script>
@stop
