@extends('layouts.theme')

@section('content')
<form method="PUT" action="javascript:void(0)" id='form-rent'>
    <input type="hidden" name="id"
        value="<?php echo $rent->id ?>" required />
    <div class="row">
        <div class="form-group col-md-3">
            <label for="client_id">Cliente</label>
            <select name="client_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($clients as $client)
                <option value="{{ $client->id }}"
                    <?php echo $rent->client->id == $client->id?'selected':''; ?> >
                    {{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="car_id">Veículo</label>
            <select name="car_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($cars as $car)
                <option value="{{ $car->id }}"
                    <?php echo $rent->car->id == $car->id?'selected':''; ?>>
                    {{ $car->model->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="type_rent_id">Tipo de locação</label>
            <select name="type_rent_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($types_rents as $type_rent)
                <option value="{{ $type_rent->id }}"
                    <?php echo $rent->type->id == $type_rent->id?'selected':''; ?>>
                    {{ $type_rent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="daily">Valor Diária</label>
            <input type="text" name="daily"
                   value="<?php echo $rent->daily; ?>"
                   class="form-control" required />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label for="init">Início</label>
            <input type="date" name="init"
                   value="<?php echo (new \DateTime($rent->init))->format('Y-m-d'); ?>"
                   class="form-control" required />
        </div>
        <div class="form-group col-md-3">
            <label for="end">Fim</label>
            <input type="date" name="end"
                   value="<?php echo (new \DateTime($rent->end))->format('Y-m-d'); ?>"
                   class="form-control" />
        </div>
        <div class="form-group col-md-6">
            <label for="comment">Observação</label>
            <textarea name="comment"
                class="form-control"><?php echo $rent->comment; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/web/rent') }}" class="btn btn-default">
                Voltar
            </a>
            <input type="button" name="rent_update"
                   id="rent_update"
                   class="btn btn-primary"
                   title="Enviar dados da locação"
                   value="Enviar"/>
            <a href="{{ url('/web/rent/'.$rent->id.'/inspection') }}"
                   class="btn btn-secondary"
                   title="Adicionar vistoria do veículo"
                   value="Vistoria">Adicionar vistoria</a>
        </div>
    </div>
</form>
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/rent/rent-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rent/rent-controller.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rent/inspection-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rent/inspection-controller.js') }}"></script>
@stop
