<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DripIrrigationModule extends Model
{
    use SoftDeletes;

    public $table = 'drip_irrigation_modules';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'area',
        'name',
        'estate_irrigation_system_id',
        'dropper_id',
        'surco_separation_id',
        'irrigation_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function estate_irrigation_system()
    {
        return $this->belongsTo(EstateIrrigationSystem::class, 'estate_irrigation_system_id');
    }

    public function dropper()
    {
        return $this->belongsTo(Dropper::class, 'dropper_id');
    }

    public function surco_separation()
    {
        return $this->belongsTo(SurcosSeparation::class, 'surco_separation_id');
    }

    public function irrigation()
    {
        return $this->belongsTo(Irrigation::class, 'irrigation_id');
    }
}
