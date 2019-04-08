<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    //

    protected $table='transaction_detail';

    
    public function product(){
    	return $this->belongsTo('App\Produk','product_id');
    }
}
