<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motorpump extends Model
{
    use SoftDeletes;

    public $table = 'motorpumps';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'brand',
        'reference',
        'hp',
        'flow',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
