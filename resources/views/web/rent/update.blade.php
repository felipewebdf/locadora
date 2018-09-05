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
                        <?php echo $rent->type->id == $type_rent->id ? 'selected' : ''; ?>>
                    {{ $type_rent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="contract_id">Contrato</label>
            <select name="contract_id" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($contracts as $contract)
                <option value="{{ $contract->id }}"
                        <?php echo $rent->contract->id == $contract->id ? 'selected' : ''; ?>>
                    {{ $contract->name }}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label for="init">Início</label>
            <input type="datetime-local" name="init"
                   value="<?php echo \DateTime::createFromFormat('Y-m-d H:i:s', $rent->init)->format('Y-m-d\TH:i') ?>"
                   class="form-control" required />
        </div>
        <div class="form-group col-md-3">
            <label for="end">Fim</label>
            <input type="datetime-local" name="end"
                   value="<?php echo \DateTime::createFromFormat('Y-m-d H:i:s', $rent->end)->format('Y-m-d\TH:i') ?>"
                   class="form-control" />
        </div>
        <div class="form-group col-md-2">
            <label for="total_km">Total km</label>
            <input type="number"
                   name="total_km"
                   value="<?php echo $rent->total_km ?>"
                   class="form-control" required />
        </div>
        <div class="form-group col-md-2">
            <label for="value_km_extra">Valor km extra</label>
            <input type="text" name="value_km_extra"
                   value="{{$rent->value_km_extra}}"
                   class="form-control" required />
        </div>
        <div class="form-group col-md-2">
            <label for="daily">Valor Diária</label>
            <input type="text" name="daily"
                   value="<?php echo $rent->daily; ?>"
                   class="form-control" required />
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
            @if(isset($inspection) && !isset($devolution))
            <a href="{{ url('/web/rent/'.$rent->id.'/devolution') }}"
               class="btn btn-secondary"
               title="Adicionar devolução do veículo"
               value="devolução">Adicionar devolução</a>
            @endif
        </div>
    </div>
</form>
<hr>
@if(isset($inspection))

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Dados da vistória
            </div>
            <div class="card-body">
                <a href="{{ url('/web/rent/'.$rent->id.'/inspection/' . $inspection->id) }}"
                   class="links"
                   title="Alterar vistoria do veículo"
                   value="Vistoria">Alterar vistoria</a>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Km inicial</h5>
                        </div>
                        <p class="mb-1">{{ $inspection->init_km }}</p>
                    </li>
                    <li class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Combustível</h5>
                        </div>
                        <p class="mb-1">{{ $inspection->gasoline }} </p>
                    </li>
                    <li class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Estado do veículo</h5>
                        </div>
                        <p class="mb-1">{{ $inspection->bodywork }} </p>
                    </li>
                    <li class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Observações</h5>
                        </div>
                        <p class="mb-1">{{ $inspection->note }} </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        @if(isset($devolution->id))
        <div class="card">
            <div class="card-header">
                Dados da devolução
            </div>
            <div class="card-body">
                <a href="{{ url('/web/rent/'.$rent->id.'/devolution/' . $devolution->id) }}"
                   class="links"
                   title="Alterar devolução do veículo"
                   value="Devolução">Alterar devolução</a>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Km final</h5>
                        </div>
                        <p class="mb-1">{{ $devolution->end_km }}</p>
                    </li>
                    <li class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Combustível</h5>
                        </div>
                        <p class="mb-1">{{ $devolution->gasoline }} </p>
                    </li>
                    <li class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Estado do veículo</h5>
                        </div>
                        <p class="mb-1">{{ $devolution->bodywork }} </p>
                    </li>
                    <li class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Observações</h5>
                        </div>
                        <p class="mb-1">{{ $devolution->note }} </p>
                    </li>
                </ul>

            </div>
        </div>
         @endif
    </div>
</div>
<hr>
@if(isset($devolution))
<div class="card">
    <div class="card-header">
        Fechamento
    </div>
    <div class="card-body">
        <ul class="list-group">
            @if($inspection->gasoline != $devolution->gasoline)
            <li class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 text-danger">Combustível inicial - Combustível final</h5>
                </div>
                <p class="mb-1">{{ $inspection->gasoline }} - {{ $devolution->gasoline }}</p>
            </li>
            @endif
            @if(($devolution->end_km - $inspection->init_km) > $rent->total_km)
            <li class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 text-danger">KM Excedido</h5>
                </div>
                <p class="mb-1">
                    {{ ($devolution->end_km - $inspection->init_km) - $rent->total_km }} km<br />
                    Valor total km excedido:
                    R$ <?php echo number_format(((($devolution->end_km - $inspection->init_km) - $rent->total_km)
                    * ((float) str_replace(',', '.',$rent->value_km_extra))), 2, ',', '.')?>
                </p>
            </li>
            @endif
            @if($inspection->bodywork != $devolution->bodywork)
            <li class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 text-danger">Estado do veículo</h5>
                </div>
                <p class="mb-1">{{ $devolution->bodywork }}</p>
            </li>
            @endif
        </ul>
    </div>
</div>
@endif
@endif
@endsection
@section('page-js-files')
<script type="text/javascript" src="{{ asset('js/rent/rent-service.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rent/rent-controller.js') }}"></script>
@stop
