<?php

namespace App\virtual\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Configuration extends Model
{
    //

    use SoftDeletes;

    public $table = 'configurations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'minimum_tension',
        'maximum_tension',
        'minimum_level_water',
        'maximum_level_water',
        'start_time',
        'end_time',
        'lamina',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function estateIrrigationSystem(){
        return $this->belongsTo(EstateIrrigationSystem::class);
    }

}
