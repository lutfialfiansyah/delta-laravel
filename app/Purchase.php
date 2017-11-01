<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    protected $table = "purchase_transaction";
    public $timestamps = false;

    public function warehouse(){
       return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }
    public function paymentTerm(){
        return $this->belongsTo(PaymentTerm::class,'payment_term_id','id');
    }
    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class,'purchase_order_id','id');
    }
    public function vendor(){
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
    public function delivery(){
        return $this->belongsTo(Delivery::class,'delivery_type_id','id');
    }
}
