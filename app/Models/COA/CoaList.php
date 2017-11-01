<?php

namespace App\Models\COA;

use Illuminate\Database\Eloquent\Model;

class CoaList extends Model
{
    //
    protected $table = "coa_list";

    public function childs(){
        return $this->hasMany(CoaList::class,'coa_parent_id','id');
    }
}
