<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
}
