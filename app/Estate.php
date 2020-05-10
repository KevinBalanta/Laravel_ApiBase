<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Estate extends Model
{
    //

   

    public $table = 'estates';

    protected $dates = [
        'created_at',
        'updated_at'
        
    ];

    protected $fillable = [
        'user_id',
        'name',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function estateIrrigationSystems(){
        return $this->hasMany(EstateIrrigationSystem::class);
    }
}
