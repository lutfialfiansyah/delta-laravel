<?php

namespace App\Http\Controllers;

use App\CustomerGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
class CustomerGroupController extends Controller
{
    //
    public function getData()
    {
        $customerGroup = CustomerGroup::all();
        return Datatables::of($customerGroup)
            ->addColumn('action', function ($customerGroup) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#" data-id="'.$customerGroup->id.'"  data-desc="'.$customerGroup->description.'"  data-name="'.$customerGroup->name.'" data-toggle="modal" class="groupedit">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#" class="delete" data-id="'.$customerGroup->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }
    public function addData(Request $request){
        $groupname = $request->input('groupname');
        $description = $request->input('description');
        //$save=1;
        try {
            $save = DB::statement("call spins_customer_group ('".$groupname."','".$description."')");
        }catch (\Exception $e){
            $save=0;
        }
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Customer Group has added!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
    public function updateData(Request $request,$id){
        $groupname = $request->input('groupname');
        $description = $request->input('description');
        //$save=1;
        try {
            $save = DB::statement("call spupd_customer_group ('".$groupname."','".$description."','".$id."')");
        }catch (\Exception $e){
            $save=0;
        }
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Customer Group has updated!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => flase, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
    public function deleteData($id){
        try {
            $save = DB::table('customer_group')->where('id', '=', $id)->update(['deleted_at'=>Carbon::now()]);
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
    public function getAllData(Request $req){
      $data = CustomerGroup::where('name', 'LIKE', '%'.$req->get('code').'%')->get();
      return Response()->json([
          'msg'=>$data
      ]);
    }
}
