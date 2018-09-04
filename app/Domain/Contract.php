<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'name',
        'company_id',
        'template'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $table = 'contract';
    protected $primaryKey = 'id';

    public function company()
    {
        return $this->hasOne('App\Domain\Company', 'id', 'company_id');
    }
}
