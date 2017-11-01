<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    protected $table = 'journal_entry';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','table_index_id','ref_id','ref_name','date','coa_list_id','debit_total','credit_total'
    ];

    public function coaList(){
        return $this->belongsTo(CoaList::class,'coa_list_id','id');
    }

}
