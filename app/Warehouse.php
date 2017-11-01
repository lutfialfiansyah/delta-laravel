<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public $timestamps = true;
    protected $table = 'warehouse';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'code', 'name', 'description', 'employee_id', 'area_id', 'address', 'created_at', 'updated_at'
    ];
    public function salesReturn(){
        return $this->hasMany(SalesReturn::class,'vendor_id', 'id');
    }
    public function branch(){
        return $this->belongsTo('App\Branch','branch_id','id');
    }
    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id','id');
    }
}
