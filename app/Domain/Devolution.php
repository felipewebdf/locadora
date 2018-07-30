<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Devolution extends Model
{
    protected $table = 'devolution';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
}
