<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table="employee";
    public function warehouse(){
        return $this->hasOne(Warehouse::class,'id');
    }
}
