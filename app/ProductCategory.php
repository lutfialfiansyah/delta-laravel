<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public $timestamps = true;
    protected $table = 'product_category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'name', 'created_at', 'updated_at'
    ];

    public function subCategory(){
        return $this->hasMany(ProductSubCategory::class, 'category_id', 'id');
    }
    public function product(){
        return $this->hasOne(Product::class,'category_id','id');
    }
}
