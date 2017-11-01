<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitConversion extends Model
{
    public $timestamps = true;
    protected $table = "unit_conversion";
    protected $fillable = [
        'product_id','unit_2_id','unit_2_qty','unit_3_id','unit_3_qty','unit_4_id','unit_4_qty','unit_5_id','unit_5_qty'
    ];

    public function product(){
        $this->belongsTo('App\Product','product_id','id');
    }
    public function unit(){
        $this->belongsTo('App\Unit','id');
    }
}
