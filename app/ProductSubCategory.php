<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    public $timestamps = false;
    protected $table = 'product_sub_category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'code','name','category_id'
    ];

    public function category(){
        return $this->belongsTo(ProductCategory::class,'category_id','id');
    }
}
