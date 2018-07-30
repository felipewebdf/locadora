<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    protected $table = 'penalty';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
}
