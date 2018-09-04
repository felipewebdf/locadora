@extends('layouts.theme')

@section('content')
<form method="PUT" action="javascript:void(0)" id='form-rent'>
    <input type="hidden" name="id"
        value="<?php echo $rent->id ?>" required />
    <div class="row">
        <div class="form-group col-md-3">
            <label for="client_id">Cliente</label>
            <select name="client_id" class="form-control" required>
                <option value="{{ $rent->client->id }}">{{ $rent->client->name }}</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="car_id">Veículo</label>
            <select name="car_id" class="form-control" required>
                <option value="{{ $rent->car->id }}">
                    {{ $rent->car->model->name }} ({{$rent->car->tag}})
                </option>
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
            <label for="km_day">Km por dia</label>
            <input type="numeric" name="km_day"
                   class="form-control"
                   value="<?php echo $rent->km_day ?>"
                   required />
        </div>
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
        <div class="form-group col-md-3">
            <label for="total_km">Total km</label>
            <input type="numeric" id="total_km" class="form-control" readonly="readonly" />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="comment">Observação</label>
            <textarea name="comment"
                class="form-control"><?php echo $rent->comment; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ url('/web/rent') }}" class="btn btn-default">
                Voltar
            </a>
            <input type="button" name="rent_update"
                   id="rent_update"
                   class="btn btn-primary"
                   title="Enviar dados da locação"
                   value="Enviar"/>
            @if(!isset($inspection))
            <a href="{{ url('/web/rent/'.$rent->id.'/inspection') }}"
                   class="btn btn-secondary"
                   title="Adicionar vistoria do veículo"
                   value="Vistoria">Adicionar vistoria</a>
            @endif
        </div>
    </div>
</form>
<hr>
@if(isset($inspection))
<div class="card">
    <div class="card-header">
        Dados da vistoria /
        <a href="{{ url('/web/rent/'.$rent->id.'/inspection/' . $inspection->id) }}"
                   class="links"
                   title="Alterar vistoria do veículo"
                   value="Vistoria">Alterar vistoria</a>
    </div>
    <div class="card-body">
        <ul>
            <li>
                Km inicial: {{ $inspection->init_km }}
            </li>
            <li>
                Combustível: {{ $inspection->gasoline }}
            </li>
            <li>
                Estado do veículo: {{ $inspection->bodywork }} <br />
            </li>
            <li>
                Observações: {{ $inspection->note }}
            </li>
        </ul>
    </div>
</div>
<hr>
@endif
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/rent/rent-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rent/rent-controller.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rent/inspection-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rent/inspection-controller.js') }}"></script>
@stop
