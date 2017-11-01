<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salesman extends Model
{
    //
    use SoftDeletes;
    protected $dates =['deleted_at'];
    protected $table="salesman";

    public function vendor(){
        return $this->belongsTo(VendorGroup::class,'vendor_group_id','id');
    }
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id','id');
    }
}
