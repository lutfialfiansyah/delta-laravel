<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class BranchController extends Controller
{
    //
    public function getData(){
        $currency = DB::table('branch')->get();
        $datatables=Datatables::of($currency);
        return $datatables->addColumn('action', function ($currency) {
            return
                '<div class="btn-group">
                                       <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#" data-description="' . $currency->description . '"  data-id="' . $currency->id . '" data-name="'. $currency->area_city_id .'" data-toggle="modal" class="btnGroupEdit">
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
        $currency = DB::table('branch')->insert([
            'code'=>$request->input('code'),
            'description'=>$request->input('description'),
            'area_city_id'=>$request->input('area')
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
                'description'=>$request->input('description'),
                'area_city_id'=>$request->input('area'),
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
    public function getBranch(){
        $data = Branch::all();
        return Response()->json([
            'msg'=>$data
        ]);
    }
}
