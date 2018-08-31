<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $fillable = [
        'car_id',
        'client_id',
        'company_id',
        'type_rent_id',
        'daily',
        'init',
        'end',
        'comment',
        'user_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $table = 'rent';
    protected $primaryKey = 'id';

    public function car()
    {
        return $this->hasOne('App\Domain\Car', 'id', 'car_id');
    }

    public function client()
    {
        return $this->hasOne('App\Domain\Client', 'id', 'client_id');
    }

    public function company()
    {
        return $this->hasOne('App\Domain\Company', 'id', 'company_id');
    }

    public function type()
    {
        return $this->hasOne('App\Domain\TypeRent', 'id', 'type_rent_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
