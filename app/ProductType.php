<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model
{
    //
    use SoftDeletes;
    protected $dates =['deleted_at'];
    protected $table='product_type';

    public function product(){
        return $this->hasMany(Product::class,'type_id','id');
    }
}
