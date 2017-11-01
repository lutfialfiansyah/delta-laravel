<?php

namespace App\Http\Controllers;

use App\ProductGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class ProductGroupController extends Controller
{

    //
    public function getData()
    {
        $productGroup = ProductGroup::all();
        return Datatables::of($productGroup)
            ->addColumn('action', function ($productGroup) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#" data-code="'.$productGroup->code.'" data-id="'.$productGroup->id.'" data-name="'.$productGroup->name.'" data-toggle="modal" class="groupedit">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#" data-id="'.$productGroup->id.'" class="delete">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }
    public function addData(Request $request){
        $groupname = $request->input('groupname');
        $code = $request->input('code');
        //$save=1;
        $cek = DB::table('product_group')
            ->select(DB::raw('count(*) as cproduct'))
            ->where('name','=',$groupname)
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
                $save = DB::statement("call spins_product_group ('" . $groupname . "','" . $code . "')");
            } catch (\Exception $e) {
                $save = 0;
            }
            if ($save) {
                return Response()->json(
                    ['status' => true, 'msg' => 'Product Group has added!', 'type' => 'success', 'title' => 'Success']
                );
            } else {
                return Response()->json(
                    ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
                );
            }
        }
    }
    public function updateData(Request $request,$id){
        $groupname = $request->input('groupname');
        //$save=1;
        try {
            $save = DB::statement("call spupd_product_group ('".$groupname."','".$id."')");
        }catch (\Exception $e){
            $save=0;
        }
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Product Group has added!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
    public function deleteData($id){
        try {
            $save = DB::table('product_group')->where('id', '=', $id)->delete();
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
        $data = ProductGroup::where('code','like','%'.$request->get('name').'%')->get();
        return Response()->json(['data'=>$data]);
    }
}
