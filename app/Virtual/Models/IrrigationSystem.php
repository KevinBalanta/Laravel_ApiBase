<?php

namespace App\virtual\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IrrigationSystem extends Model
{
    //

    use SoftDeletes;

    public $table = 'irrigation_systems';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function estateIrrigationSystems(){
        return $this->hasMany(EstateIrrigationSystem::class);
    }
}