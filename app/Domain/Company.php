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
        return $this->hasOne('App\Address', 'foreign_key', 'address_id');
    }

}
