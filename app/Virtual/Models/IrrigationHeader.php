<?php

namespace App\virtual\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IrrigationHeader extends Model
{
    use SoftDeletes;

    public $table = 'irrigation_headers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'motorpump_id',
        'estate_id',
        'water_source_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function motorpump()
    {
        return $this->belongsTo(Motorpump::class, 'motorpump_id');
    }

    public function estate()
    {
        return $this->belongsTo(Estate::class, 'estate_id');
    }

    public function water_source()
    {
        return $this->belongsTo(WaterSource::class, 'water_source_id');
    }
}
