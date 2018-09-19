<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{

    protected $table = 'provider';
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';

}
