<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoaType extends Model
{
    protected $table = 'coa_type';

    public function coaList(){
        return $this->hasMany(CoaList::class,'coa_type_id','id');
    }
}
