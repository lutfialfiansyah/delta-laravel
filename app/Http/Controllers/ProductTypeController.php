<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProductTypeController extends Controller
{
    //
    public function getData()
    {
        $productType = ProductType::all();
        return Datatables::of($productType)
            ->addColumn('action', function ($productType) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#" data-code="'.$productType->code.'" data-id="'.$productType->id.'" data-name="'.$productType->name.'" data-toggle="modal" class="typeedit">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#" class="delete" data-id="'.$productType->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }
    public function addData(Request $request){
        $typename = $request->input('typename');
        $code = $request->input('code');
        //$save=1;
        $cek = DB::table('product_type')
            ->select(DB::raw('count(*) as cproduct'))
            ->where('name','=',$typename)
            ->groupBy('name')
            ->get()
            ->first();
        //echo  json_encode($cek);
        if(isset($cek->cproduct)){
            return Response()->json(
                ['status' => true, 'msg' => 'data already exists!', 'type' => 'warning', 'title' => 'Ops']
            );
        }else {
            try {
                $save = DB::statement("call spins_product_type ('".$typename."','".$code."')");
            }catch (\Exception $e){
                $save=0;
            }
            if($save) {
                return Response()->json(
                    ['status' => true, 'msg' => 'Product Type has added!','type'=>'success','title'=>'Success']
                );
            }else {
                return Response()->json(
                    ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
                );
            }
        }
    }
    public function updateData(Request $request,$id){
        $typename = $request->input('typename');
        //$save=1;
        try {
            $save = DB::statement("call spupd_product_type ('".$typename."','".$id."')");
        }catch (\Exception $e){
            $save=0;
        }
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Product Type has Updated!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
    public function deleteData($id){
        try {
            $save = DB::table('product_type')->where('id', '=', $id)->delete();
        }catch (\Exception $e){
            $save=0;
        }
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Data has Deleted!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
public function getAllData(Request $request){
        $data = ProductType::where('id','like','%'.$request->get('name').'%')->get();
        return Response()->json(['data'=>$data]);
    }
}
