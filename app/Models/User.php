<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Extensions\Contracts\Auth\Authenticatable as AuthenticatableContract;
use App\Models\Profile;

class User extends Authenticatable implements JWTSubject, AuthenticatableContract
{
    use Notifiable;

    protected $with = ['profile'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function getAuthPasswordName(){
        return 'password';
    }

    public function getAuthPassword(){
        return $this->password;
    }


    public function isAdmin(){
        return $this->profile->name === 'Administrador';
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function estates(){
        return $this->hasMany(Estate::class);
    }


    public function profile(){
        return $this->belongsTo(Profile::class);
    }



    

    

}
