<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
	protected $table = "product_detail";
	public function vendor(){
		return $this->belongsTo('App\Vendor','vendor_id','id');
	}
}
