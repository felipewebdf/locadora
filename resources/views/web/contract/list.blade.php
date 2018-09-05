@extends('layouts.theme')

@section('content')
<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{url('web/company/contract/create')}}"
        name="add_contract"
        title="Adicionar contrato"
        class="btn btn-primary right">Adicionar contrato</a>
    </div>
</div>
<br />
<table class="table table-hover">
    <thead>
        <tr>
            <th>Nome</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contracts as $contract)
        <tr title="Clique na linha para editar esse contrato"
            style='cursor: pointer' itemref="{{ url('/web/company/contract/update/' . $contract->id) }}"
            class='form_update'>
            <td>{{ $contract->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/company/contract-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/company/contract-controller.js') }}"></script>
@stop
