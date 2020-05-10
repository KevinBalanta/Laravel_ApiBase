<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DripIrrigationOperation extends Model
{
    use SoftDeletes;

    public $table = 'drip_irrigation_operations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tension',
        'mesocosmo',
        'action_id',
        'irrigation_module_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function action()
    {
        return $this->belongsTo(Action::class, 'action_id');
    }

    public function irrigation_module()
    {
        return $this->belongsTo(DripIrrigationModule::class, 'irrigation_module_id');
    }
}
