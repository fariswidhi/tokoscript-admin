<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //

    protected $table='transactions';

    public function metodePembayaran(){
    	return $this->belongsTo('App\MetodePembayaran','metode_pembayaran','id');
    }

    public function akunBank(){
    	return $this->belongsTo('App\AkunBank','metode_pembayaran','metode_pembayaran');
    }

    public function user(){
    	return $this->belongsTo('App\User','userid','id');
    }
    
}
