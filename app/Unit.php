<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = "unit";
    protected $fillable = ['name'];

    public function product(){
        return $this->hasMany('App\Product','unit_id','id');
    }
    public function productUnit(){
        return $this->hasMany('App\UnitConversion','id');
    }
    public function stockBeginning(){
        return $this->hasOne('App\StockBeginning','id');
    }
    public $timestamps = true;
}
