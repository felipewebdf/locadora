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
        return $this->hasOne('App\Domain\Address', 'foreign_key', 'address_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'foreign_key', 'user_id');
    }

}
