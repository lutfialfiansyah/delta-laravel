<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    //
    protected $table ="sales_order";

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function salesman(){
        return $this->belongsTo(Salesman::class,'salesman_id','id');
    }
    public function user(){
      return $this->belongsTo('App\User','updated_by','id');
    }
    public function paymentTerm(){
        return $this->belongsTo('App\PaymentTerm','payment_term_id','id');
    }
    public function delivery(){
      return $this->belongsTo('App\Delivery','delivery_type_id','id');
    }
    public function currency(){
      return $this->belongsTo('App\Currency','currency_id','id');
    }
}
