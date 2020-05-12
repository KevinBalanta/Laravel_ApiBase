<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WaterSource extends Model
{
    use SoftDeletes;

    public $table = 'water_sources';

    

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'capacity',
        'uptake_time',
        'type_id',
        'estate_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function type()
    {
        return $this->belongsTo(WaterSourceType::class, 'type_id');
    }

    public function estate()
    {
        return $this->belongsTo(Estate::class, 'estate_id');
    }
}
