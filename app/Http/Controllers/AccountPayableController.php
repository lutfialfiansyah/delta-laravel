<?php

namespace App\Http\Controllers;

use App\AccountPayable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class AccountPayableController extends Controller
{
    //
    public function getData(){
        $ap = DB::table('ap_balance_beginning as a')
            ->join('vendor as b','a.vendor_id','=','b.id')
            ->select('a.id','a.vendor_id','b.code','b.name','a.total','updated_by','a.created_at')
            ->get();
        return Datatables::of($ap)
            ->addColumn('total', function ($ap) {
                return 'Rp. '.number_format($ap->total);
            })
            ->addColumn('action', function ($ap) {
                return
                    '<div class="btn-group">
                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li>
                                                <a href="#" data-id="'.$ap->id.'"  data-productid="'.$ap->vendor_id.'" data-name="'.$ap->vendor_id.'" data-qty="'.$ap->total.'"  data-toggle="modal" class="stockedit">
                                                    <i class="icon-tag"></i> Edit </a>
                                            </li>
                                            <li>
                                                <a href="#" class="delete" data-id="'.$ap->id.'">
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
        $cek = DB::table('ap_balance_beginning')
            ->select(DB::raw('count(*) as ap'))
            ->where('vendor_id','=',$vendor)
            ->groupBy('vendor_id')
            ->get()
            ->first();
        //echo  json_encode($cek);
        if(isset($cek->cproduct)){
            return Response()->json(
                ['status' => true, 'msg' => 'Vendor already exists!', 'type' => 'warning', 'title' => 'Ops']
            );
        }else{
            $ap = new AccountPayable();
            $ap->vendor_id=$vendor;
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
        $ap = AccountPayable::where('id',$id)->first();
        $ap->vendor_id=$vendor;
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
