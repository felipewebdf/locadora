<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class TypeRent extends Model
{

    protected $fillable = [
        'name'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $table = 'type_rent';
    protected $primaryKey = 'id';

}
