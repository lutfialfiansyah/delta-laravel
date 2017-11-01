<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoaList extends Model
{
    protected $table = 'coa_list';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','coa_type_id','code','name','remarks','parent_status'
    ];

    public function journal(){
        return $this->hasMany(JournalEntry::class,'coa_list_id','id');
    }
    public function coaPivotParent(){
        return $this->hasMany(CoaPivotParent::class,'coa_parent_id','id');
    }
    public function coaPivotChild(){
        return $this->hasMany(CoaPivotParent::class,'coa_list_id','id');
    }
    public function coaType(){
        return $this->belongsTo(CoaType::class,'coa_type_id','id');
    }
    public function coaControl(){
        return $this->hasOne(CoaControl::class,'coa_list_id','id');
    }
}
