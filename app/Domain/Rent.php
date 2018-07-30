<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $table = 'rent';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
}
