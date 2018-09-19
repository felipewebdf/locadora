<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class ModelCar extends Model
{

    protected $fillable = [
        'name',
        'brand_id'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $table = 'model';
    protected $primaryKey = 'id';

    public function brand()
    {
        return $this->hasOne('App\Domain\Brand', 'id', 'brand_id');
    }

}
