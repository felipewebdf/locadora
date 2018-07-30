<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class TypeRent extends Model
{
    protected $table = 'type_rent';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
}
