<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSystem extends Model
{
    //

    protected $table='user_system';

    public function roles(){
    	return $this->belongsTo('App\Role','role','id');
    }
    
}
