<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Rayon Model
 */
class User extends Model
{
  
    /** @var string Filter Class */
    protected $table ='users';
    public $timestamps = false;
   
}
