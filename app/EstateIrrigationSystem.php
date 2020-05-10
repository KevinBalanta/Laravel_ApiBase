<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstateIrrigationSystem extends Model
{
    use SoftDeletes;

    public $table = 'estate_irrigation_systems';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'estate_id',
        'irrigation_system_id',
        'configuration_id',
        'irrigation_header_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function estate()
    {
        return $this->belongsTo(Estate::class, 'estate_id');
    }

    public function irrigation_system()
    {
        return $this->belongsTo(IrrigationSystem::class, 'irrigation_system_id');
    }

    public function configuration()
    {
        return $this->belongsTo(Configuration::class, 'configuration_id');
    }

    public function irrigation_header()
    {
        return $this->belongsTo(IrrigationHeader::class, 'irrigation_header_id');
    }

   
    
}
