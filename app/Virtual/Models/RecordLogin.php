<?php

namespace App\virtual\Models;

use Illuminate\Database\Eloquent\Model;

class RecordLogin extends Model
{
    //
    protected $connection = 'application';
    protected $table = 'record_login';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'id', 'user_id','ip_source', 'date', 'time', 'php_session_id', 'date_out', 'time_out', 'active'
    ];

    protected $hidden = [
    ];
}
