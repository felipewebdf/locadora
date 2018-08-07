<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['description', 'district', 'cep', 'city', 'uf'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $table = 'address';
    protected $primaryKey = 'id';
}
