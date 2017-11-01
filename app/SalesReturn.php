<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesReturn extends Model
{
    public $timestamps = true;
    protected $table = 'sales_return';
    protected $primaryKey = 'id';
    protected $fillable = [
      'id', 'sales_return_no', 'date', 'warehouse_id', 'cendor_id', 'total', 'delivery_type_id', 'remarks'
    ];
    public function warehouse(){
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }
}
