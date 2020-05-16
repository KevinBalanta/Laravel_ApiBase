<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class DropperType extends Model
{


    

    public $table = 'dropper_types';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];

    public function droppers()
    {
        return $this->hasMany(Dropper::class);

    }
}
