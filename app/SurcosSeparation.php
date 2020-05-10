<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurcosSeparation extends Model
{
    use SoftDeletes;

    public $table = 'surcos_separations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'value',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
