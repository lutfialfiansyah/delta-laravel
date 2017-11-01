<?php

namespace App\Http\Controllers;

use App\AccountReceivable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class AccountReceivableController extends Controller
{
    //
    public function getData(){
        $ar = DB::table('ar_balance_beginning as a')
            ->join('customer as b','a.customer_id','=','b.id')
            ->select('a.id','a.customer_id','b.code','b.name','a.total','updated_by','a.created_at')
            ->get();
        return Datatables::of($ar)
            ->addColumn('total', function ($ar) {
                return 'Rp. '.number_format($ar->total);
            })
            ->addColumn('action', function ($ar) {
                return
                    '<div class="btn-group">
                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li>
                                                <a href="#" data-id="'.$ar->id.'"  data-productid="'.$ar->customer_id.'" data-name="'.$ar->customer_id.'" data-qty="'.$ar->total.'"  data-toggle="modal" class="stockedit">
                                                    <i class="icon-tag"></i> Edit </a>
                                            </li>
                                            <li>
                                                <a href="#" class="delete" data-id="'.$ar->id.'">
                                                    <i class="icon-docs"></i> Delete </a>
                                            </li>
                                        </ul>
                                    </div>';
            })
            ->make(true);
    }
    public function addData(Request $request){
        $vendor = $request->input('vendor_id');
        $qty = $request->input('total');
        $cek = DB::table('ar_balance_beginning')
            ->select(DB::raw('count(*) as ar'))
            ->where('customer_id','=',$vendor)
            ->groupBy('customer_id')
            ->get()
            ->first();
        //echo  json_encode($cek);
        if(isset($cek->cproduct)){
            return Response()->json(
                ['status' => true, 'msg' => 'Data already exists!', 'type' => 'warning', 'title' => 'Ops']
            );
        }else{
            $ap = new AccountReceivable();
            $ap->customer_id=$vendor;
            $ap->total=$qty;
            if($ap->save()) {
                return Response()->json(
                    ['status' => true, 'msg' => 'Data has added!','type'=>'success','title'=>'Success']
                );
            }else {
                return Response()->json(
                    ['status' => true, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
                );
            }
        }
    }
    public function updateData(Request $request,$id){
        $vendor = $request->input('vendor_id');
        $qty = $request->input('total');
        $ap = AccountReceivable::where('id',$id)->first();
        $ap->customer_id=$vendor;
        $ap->total=$qty;
        if($ap->update()) {
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
            $save = DB::table('ap_balance_beginning')->where('id', '=', $id)->delete();
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
