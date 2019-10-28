<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $fillable = [
        'name',
        'cnh',
        'cnh_category',
        'document',
        'rg',
        'credcard',
        'credcard_at',
        'credcard_name',
        'credcard_cod',
        'phone',
        'phone_cel',
        'address_id',
        'user_id',
        'company_id',
        'note'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'cnh_at',
    ];
    protected $table = 'client';
    protected $primaryKey = 'id';

    public function company()
    {
        return $this->hasOne('App\Domain\Company', 'id', 'company_id');
    }

    public function address()
    {
        return $this->hasOne('App\Domain\Address', 'id', 'address_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
