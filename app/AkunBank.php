<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Rayon Model
 */
class AkunBank extends Model
{
  
    /** @var string Filter Class */
    protected $table ='akun_bank';
    public $timestamps = false;
   

   
    public function metodePembayaran(){
    	return $this->belongsTo('App\MetodePembayaran','metode_pembayaran','id');
    }
}
