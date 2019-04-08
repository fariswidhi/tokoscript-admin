<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Rayon Model
 */
class Tag extends Model
{
  
    /** @var string Filter Class */
    protected $table ='tags';
    public $timestamps = false;
   
}
