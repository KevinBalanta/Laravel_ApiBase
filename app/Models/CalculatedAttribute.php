<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalculatedAttribute extends Model
{
    use SoftDeletes;

    public $table = 'calculated_attributes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'value',
        'indicator_id',
        'module_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function indicator()
    {
        return $this->belongsTo(Indicator::class, 'indicator_id');
    }

    public function module()
    {
        return $this->belongsTo(DripIrrigationModule::class, 'module_id');
    }
}
