<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
}
