<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBrand extends Model
{
    //
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $table="product_brand";
    public function product(){
        return $this->hasOne('App/Product','brand_id','id');
    }

}
