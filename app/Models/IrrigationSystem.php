<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IrrigationSystem extends Model
{
    

    public $table = 'irrigation_systems';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];

    public function estateIrrigationSystems(){
        return $this->hasMany(EstateIrrigationSystem::class);
    }
}
