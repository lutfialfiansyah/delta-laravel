<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorGroup extends Model
{
    //
    use SoftDeletes;
    protected $dates =['deleted_at'];
    protected $table = 'vendor_group';
    public $timestamps = true;
    public function vendor(){
        $this->belongsTo('App\Vendor','id');
    }
}
