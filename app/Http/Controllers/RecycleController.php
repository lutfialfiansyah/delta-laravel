<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecycleController extends Controller
{
    //
    public function product(){
        return view('modules.recycle.product_recycle');
    }
}
