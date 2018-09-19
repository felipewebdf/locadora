<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = ['name', 'cnpj'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $table = 'company';
    protected $primaryKey = 'id';

    public function address()
    {
        return $this->hasOne('App\Domain\Address', 'id', 'address_id');
    }

    public function user()
    {
        return $this->hasOne('App\Domain\User', 'id', 'user_id');
    }

}
