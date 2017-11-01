<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Helpers\MegaTrend;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class DeliveryController extends Controller
{
    //
    public function getData(){
        $delivery = Delivery::all();
        return Datatables::of($delivery)
            ->addColumn('action', function ($delivery) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="'.route('edit.delivery',$delivery->id).'" data-id="'.$delivery->id.'" data-name="'.$delivery->name.'" data-toggle="modal" class="brandedit">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#"class="delete" data-id="'.$delivery->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }
    public function insertDelivery(){
        $code = MegaTrend::getLastCode('SM','delivery_type','code');
        return view('modules.delivery.insert_delivery',compact('code'));
    }
    public function editDelivery($id){
        $data = DB::table('delivery_type')
            ->where('id','=',$id)
            ->get()
            ->first();
        return view('modules.delivery.edit_delivery',compact('data'));
    }
    public function addData(Request $request){
        $sql = "call spins_delivery('".$request->input('code')."' ,'".$request->input('name')."','".$request->input('vendor_id')."')";
        try {
            $save =DB::statement($sql);
        }catch (\Exception $e){
            echo $e->getMessage();
            $save=0;
        }
        //$save=0;
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Shipping Method has added!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'error','title'=>'Ops!!']
            );
        }
    }
    public function updateData(Request $request,$id){
        $sql = "call spupd_delivery('".$request->input('code')."' ,'".$request->input('name')."','".$request->input('vendor_id')."','".$id."')";
        try {
            $save =DB::statement($sql);
        }catch (\Exception $e){
            $save=0;
        }
        //$save=0;
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Shipping Method has updated!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'error','title'=>'Ops!!']
            );
        }
    }
    public function deleteData($id){
        try {
            $save = DB::table('delivery')->where('id', '=', $id)->delete();
        }catch (\Exception $e){
            $save=0;
        }
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'data has Deleted!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
    public function getAllData(Request $request){
        $data = Delivery::where('code','like','%'.$request->get('code').'%')->get();
        return Response()->json([
          'msg'=>$data
        ]);
    }
}
