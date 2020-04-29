<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $connection = 'application';
    protected $table = 'profiles';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
    ];

   

    //Relaciones
    public function modules(){
        return $this->belongsToMany('App\Models\Module', 'profile_module', 'profile_id', 'module_id')->as('access_control')->withPivot('create_permission', 'update_permission', 'delete_permission')->withTimestamps();
    }

    public function toArray(){
        $this->modules;
        return parent::toArray();
    }
}
