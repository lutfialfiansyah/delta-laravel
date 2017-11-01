<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table="product";
    public $timestamps = false;

    public function productBrand(){
        return $this->belongsTo('App\ProductBrand','brand_id','id');
    }
    public function productUnit(){
        return $this->belongsTo('App\UnitConversion','unit_id','id');
    }
    public function unit(){
        return $this->belongsTo('App\Unit','unit_id','id');
    }
    public function productGroup(){
        return $this->belongsTo('App\ProductGroup','group_id','id');
    }
    public function productCategory(){
        return $this->belongsTo('App\ProductCategory','category_id','id');
    }
    public function productSubCategory(){
        return $this->belongsTo('App\ProductSubCategory','sub_cat_id','id');
    }
    public function stockBeginning(){
        return $this->hasOne(StockBeginning::class,'product_id','id');
    }
    public function type(){
        return $this->belongsTo(ProductType::class,'type_id','id');
    }
}
