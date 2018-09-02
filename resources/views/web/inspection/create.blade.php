@extends('layouts.theme')

@section('content')
<form method="POST" action="javascript:void(0)" id='form-inspection'>
    <input type="hidden" name="rent_id" value="{{$rent_id}}" />
    <div class="row">
        <div class="form-group col-md-3">
            <label for="init_km">Km inicial</label>
            <input type="text" name="init_km" class="form-control" required />
        </div>
        <div class="form-group col-md-3">
            <label for="gasoline">Combustível</label>
            <input type="text" name="gasoline" class="form-control" required />
        </div>
        <div class="form-group col-md-3">
            <label for="bodywork">Lataria</label>
            <input type="text" name="bodywork" class="form-control" required />
        </div>
        <div class="form-group col-md-3">
            <label for="washed_out">Lavagem</label>
            <input type="text" name="washed_out" class="form-control" required />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="note">Observações</label>
            <textarea name="note" class="form-control" ></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/web/rent/' . $rent_id) }}" class="btn btn-default">
                Voltar
            </a>
            <input type="submit" name="inspection_submit"
                   class="btn btn-primary"
                   title="Enviar dados da vistoria"
                   value="Enviar"/>
        </div>
    </div>
</form>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/inspection/inspection-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/inspection/inspection-controller.js') }}"></script>
@stop
