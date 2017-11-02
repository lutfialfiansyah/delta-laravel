<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSpec extends Model
{
    protected $table = "product_spec";
    public function product(){
    	return $this->belongsTo('App\Product','product_id','id');
    }
}
