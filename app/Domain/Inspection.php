<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $table = 'inspection';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
}
