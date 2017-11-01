<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
    protected $table="branch";

    public function stockBeginning(){
        return $this->hasOne('App\StockBeginning','id');
    }
    public function warehouse(){
        return $this->hasOne('App\Warehouse','branch_id','id');
    }
}
