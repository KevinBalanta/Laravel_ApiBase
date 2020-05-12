<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dropper extends Model
{


    use SoftDeletes;

    public $table = 'droppers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'flow',
        'separation',
        'dropper_type_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function dropper_type()
    {
        return $this->belongsTo(DropperType::class, 'dropper_type_id');
    }

}
