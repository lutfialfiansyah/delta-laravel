<?php

namespace App\Http\Controllers;

use App\StockBeginning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class StockBeginningController extends Controller
{
    //
    public function getData(){
        $stock = StockBeginning::all();
        return Datatables::of($stock)
            ->addColumn('branch_id', function ($stock){
                return $stock->branch->description;
            })
            ->addColumn('productname', function ($stock) {
                return $stock->product->name;
            })
            ->addColumn('productcode', function ($stock) {
                return $stock->product->code;
            })
            ->addColumn('unit_id', function ($stock){
                return $stock->unit->name;
            })
            ->addColumn('action', function ($stock) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#" data-id="'.$stock->id.'"  data-productid="'.$stock->product_id.'" data-name="'.$stock->product->name.'" data-qty="'.$stock->qty.'"  data-toggle="modal" class="stockedit">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#" class="delete" data-id="'.$stock->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }
    public function addData(Request $request){
        $productid = $request->input('productid');
        $qty = $request->input('qty');
        $branch = $request->input('branchid');
        $unit= $request->input('unitid');
        $cek = DB::table('stock_beginning')
            ->select(DB::raw('count(*) as cproduct'))
            ->where('product_id','=',$productid)
            ->groupBy('product_id')
            ->get()
            ->first();
       //echo  json_encode($cek);
       if(isset($cek->cproduct)){
            return Response()->json(
                ['status' => true, 'msg' => 'Product already exists!', 'type' => 'warning', 'title' => 'Ops']
            );
        }else{
        try {
            $save = DB::statement("call spins_stock_beginning ('".$productid."','".$qty."','".$branch."','".$unit."')");
        }catch (\Exception $e){
            $save=0;
        }
        //$save=1;
            if($save) {
                return Response()->json(
                    ['status' => true, 'msg' => 'Product Brand has added!','type'=>'success','title'=>'Success']
                );
            }else {
                return Response()->json(
                    ['status' => true, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
                );
            }
        }
    }
    public function updateData(Request $request,$id){
        $productid = $request->input('productid');
        $qty = $request->input('qty');
        $branch = $request->input('branchid');
        $unit = $request->input('unitid');
        //$save=1;
        try {
            $save = DB::statement("call spupd_stock_beginning ('".$productid."','".$qty."','".$id."','".$branch."','".$unit."')");
        }catch (\Exception $e){
            $save=0;
            echo $e->getMessage();
        }
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Data has updated!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => true, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
    public function deleteData($id){
        try {
            $save = StockBeginning::where('id',$id)->delete();
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
}
