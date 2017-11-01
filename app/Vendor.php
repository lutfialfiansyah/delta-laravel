<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public $timestamps = true;
    protected $table = "vendor";

    public function purchaseOrder(){
    return $this->hasOne('App\PurchaseOrder','vendor_id','id');
    }
    public function vendorGroup(){
        return $this->hasMany('App\VendorGroup','vendor_group_id','id');
    }
}
