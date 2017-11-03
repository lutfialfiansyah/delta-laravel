<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    //
    protected $table="purchase_order";
    public $timestamps =true;

    public function vendor(){
        $this->belongsTo('App\Vendor','id');
    }
    public function getUser(){
       return $this->belongsTo('App\User','updated_by','id');
    }
}
