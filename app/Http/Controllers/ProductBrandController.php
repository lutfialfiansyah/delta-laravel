<?php

namespace App\Http\Controllers;

use App\ProductBrand;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProductBrandController extends Controller
{
    //
    public function getData()
    {
        $brands = ProductBrand::all();
        return Datatables::of($brands)
            ->addColumn('action', function ($brands) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#" data-code="'.$brands->code.'" data-id="'.$brands->id.'" data-name="'.$brands->name.'" data-toggle="modal" class="brandedit">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#" class="delete" data-id="'.$brands->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }
    public function addData(Request $request){
        if($request->isJson()){
            $brandname = $request->json('brandname');
        }else{
            $brandname = $request->input('brandname');
        }
        $code = $request->input('code');
        //$save=1;
        $cek = DB::table('product_brand')
            ->select(DB::raw('count(*) as cproduct'))
            ->where('name','=',$brandname)
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
                $save = DB::statement("call spins_product_brand ('" . $brandname . "','" . $code . "')");
            } catch (\Exception $e) {
                $save = 0;
            }
            if ($save) {
                return Response()->json(
                    ['status' => true, 'msg' => 'Product Brand has added!', 'type' => 'success', 'title' => 'Success']
                );
            } else {
                return Response()->json(
                    ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
                );
            }
        }
    }
    public function updateData(Request $request,$id){
        $brandname = $request->input('brandname');

        //$save=1;
        try {
            $save = DB::statement("call spupd_product_brand ('".$brandname."','".$id."')");
        }catch (\Exception $e){
            $save=0;
        }
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Product Brand has updated!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
    public function deleteData($id){
        try {
            $save = ProductBrand::where('id',$id)->delete();
        }catch (\Exception $e){
            $save=0;
        }
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Product has Deleted!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
    public function getAllData(Request $request){
        $data = ProductBrand::where('id','like','%'.$request->get('name').'%')->get();
        return Response()->json(['data'=>$data]);
    }
}