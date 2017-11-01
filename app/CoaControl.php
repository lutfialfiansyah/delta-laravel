<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoaControl extends Model
{
    protected $table = 'coa_control';

    public function coaList(){
        return $this->belongsTo(CoaList::class,'coa_list_id','id');
    }
}
