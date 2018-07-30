<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
}
