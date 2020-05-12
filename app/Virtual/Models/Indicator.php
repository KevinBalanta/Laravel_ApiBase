<?php

namespace App\virtual\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indicator extends Model
{
    use SoftDeletes;

    public $table = 'indicators';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'units',
        'name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
