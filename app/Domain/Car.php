<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'automaker',
        'model',
        'power',
        'year_factory',
        'year',
        'tag',
        'renavan',
        'door',
        'capacity',
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
}
