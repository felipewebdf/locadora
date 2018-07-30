<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    protected $table = 'daily';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
}
