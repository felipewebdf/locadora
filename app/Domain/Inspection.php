<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $fillable = [
        'rent_id',
        'user_id',
        'init_km',
        'gasoline',
        'bodywork',
        'washed_out',
        'note'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $table = 'inspection';
    protected $primaryKey = 'id';

    public function rent()
    {
        return $this->hasOne('App\Domain\Rent', 'id', 'rent_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
