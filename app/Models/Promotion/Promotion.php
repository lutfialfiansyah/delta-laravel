<?php

namespace App\Models\Promotion;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //
    protected $table="promotion_product";
    public function users(){
       return $this->belongsTo('App\User','updated_by','id');
    }
    public function unit(){
       return $this->belongsTo('App\Unit','unit_id','id');
    }
}
