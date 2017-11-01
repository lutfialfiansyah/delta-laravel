<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesTransaction extends Model
{
    //
    protected $table="sales_transaction";

    public function werehouse(){
        return $this->belongsTo(Warehouse::class,'werehouse_id','id');
    }
    public function salesman(){
        return $this->belongsTo(Salesman::class,'salesman_id','id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function paymentTerm(){
        return $this->belongsTo(PaymentTerm::class,'payment_term_id','id');
    }
    public function delivery(){
        return $this->belongsTo(Delivery::class,'delivery_type_id','id');
    }
    public function currency(){
      return $this->belongsTo(Currency::class,'currency_id','id');
    }
}
