<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Irrigation extends Model
{
    use SoftDeletes;

    public $table = 'irrigations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'amount_hours',
        'frequency_days',
        'amount_minutes',
        'strategy_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function strategy()
    {
        return $this->belongsTo(IrrigationStrategy::class, 'strategy_id');
    }
}
