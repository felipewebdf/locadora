<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $fillable = [
        'name'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $table = 'brand';
    protected $primaryKey = 'id';

}
