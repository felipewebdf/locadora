<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'car';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
}
