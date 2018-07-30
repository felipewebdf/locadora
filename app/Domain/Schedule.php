<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
}
