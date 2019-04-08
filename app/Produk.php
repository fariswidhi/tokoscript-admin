<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Rayon Model
 */
class Produk extends Model
{
  
    /** @var string Filter Class */
    protected $table ='produk';
    public $timestamps = false;
   

       public function kategory(){
    	return $this->belongsTo('App\Kategori','kategori_id');
    }

}
