<?php

namespace App\Models;

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

    public function waterSources(){
        return $this->hasMany(WaterSource::class);
    }

    public function irrigationHeaders(){
        return $this->hasMany(IrrigationHeader::class);
    }
}
