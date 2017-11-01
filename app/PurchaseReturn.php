<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    //
    protected $table="purchase_return";
    public function warehouse(){
    	return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }
    public function vendor(){
    	return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
     public function delivery(){
    	return $this->belongsTo(Delivery::class,'delivery_type_id','id');
    }
}
