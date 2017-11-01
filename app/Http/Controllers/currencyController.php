<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class currencyController extends Controller
{
    //
    public function getData(){
        $currency = DB::table('currency')->get();
        $datatables=Datatables::of($currency);
        return $datatables->addColumn('action', function ($currency) {
                return
                    '<div class="btn-group">
                                       <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#" data-symbol="' . $currency->symbol . '"  data-id="' . $currency->id . '" data-name="'. $currency->name .'" data-toggle="modal" class="btnGroupEdit">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#" data-id="' . $currency->id . '" class="delete">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }
    public function addData(Request $request){
        $currency = DB::table('currency')->insert([
            'code'=>$request->input('code'),
            'symbol'=>$request->input('simbol'),
            'name'=>$request->input('name')
        ]);
        if($currency) {
            return Response()->json(
                ['status' => true, 'msg' => 'Data has added!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
    public function updateData(Request $request,$id){
        $currency = DB::table('currency')
            ->where('id',$id)
            ->update([
            'code'=>$request->input('code'),
            'symbol'=>$request->input('simbol'),
            'name'=>$request->input('name'),
            'updated_at'=>Carbon::now()
        ]);
        if($currency) {
            return Response()->json(
                ['status' => true, 'msg' => 'Data has added!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
    public function getAllData(Request $request){
       $data = DB::table('currency')->where('name','like','%'.$request->get('code').'%')->get();
       return Response()->json([
         'msg'=>$data
       ]);
    }
}
