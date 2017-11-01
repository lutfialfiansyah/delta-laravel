<?php

namespace App\Http\Controllers\tax;

use Illuminate\Http\Request;
use App\Models\tax\Tax;
use App\Http\Controllers\Controller;

class TaxController extends Controller
{
    //
    public function getAllData(Request $request){
        $data = Tax::where('name','like','%'.$request->code.'%')->get();
        return Response()->json(['msg'=>$data]);
    }

}
