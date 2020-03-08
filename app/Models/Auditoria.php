<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $connection = 'application';
    protected $table = 'auditoria';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = false;


    
}
