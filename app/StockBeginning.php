<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockBeginning extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table ="stock_beginning";

    public function product(){
        return $this->belongsTo('App\Product','product_id','id');
    }
    public function branch(){
        return $this->belongsTo('App\Branch','branch_id','id');
    }
    public function unit(){
        return $this->belongsTo('App\Unit','unit_id','id');
    }
}
