<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    //
    use SoftDeletes;
    protected $dates =['deleted_at'];
    protected $table="customer";
}
