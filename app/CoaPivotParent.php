<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoaPivotParent extends Model
{
    protected $table = 'coa_pivot_parent';

    public function coaParent(){
        return $this->belongsTo(CoaList::class,'coa_parent_id','id');
    }
    public function coaList(){
        return $this->belongsTo(CoaList::class,'coa_list_id','id');
    }
    public function childs(){
        return $this->hasMany(CoaPivotParent::class,'coa_parent_id','id');
    }

}
