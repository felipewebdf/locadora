<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    static public $arrFuel = [
        1 => 'Diesel',
        2 => 'Etanol',
        3 => 'Flex',
        4 => 'Gás',
        5 => 'Gasolina'
    ];

    static public $arrColor = [
        1 => 'Amarelo',
        2 => 'Azul',
        3 => 'Branco',
        4 => 'Cinza',
        5 => 'Grafite',
        6 => 'Marrom',
        7 => 'Ouro',
        8 => 'Prata',
        9 => 'Preta',
        10 => 'Rosa',
        11 => 'Verde',
        12 => 'Vermelho'
    ];

    protected $fillable = [
        'model_id',
        'power',
        'year_factory',
        'year',
        'tag',
        'renavan',
        'chassi',
        'door',
        'type_fuel',
        'capacity',
        'color',
        'company_id',
        'provider_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $table = 'car';
    protected $primaryKey = 'id';

    public function company()
    {
        return $this->hasOne('App\Domain\Company', 'id', 'company_id');
    }

    public function provider()
    {
        return $this->hasOne('App\Domain\Provider', 'id', 'provider_id');
    }

    public function model()
    {
        return $this->hasOne('App\Domain\ModelCar', 'id', 'model_id');
    }
}
