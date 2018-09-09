<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'cnh',
        'document',
        'credcard',
        'credcard_at',
        'phone',
        'address_id',
        'user_id',
        'company_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
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
