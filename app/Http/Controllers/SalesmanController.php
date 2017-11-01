<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Helpers\MegaTrend;
use App\Salesman;
use App\VendorGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class SalesmanController extends Controller
{
    //
    public function getData(){
        $salesman = Salesman::all();
        return Datatables::of($salesman)
            ->addColumn('name', function ($salesman) {
                return $salesman->employee->first_name." ".$salesman->employee->last_name;
            })
            ->addColumn('employee_no', function ($salesman) {
                return $salesman->employee->employee_no;
            })
            ->addColumn('email', function ($salesman) {
                return $salesman->employee->email;
            })
            ->addColumn('action', function ($salesman) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="salesman/detail/'.$salesman->id.'" >
                                                <i class="icon-tag"></i> Detail </a>
                                        </li>
                                        <li>
                                            <a href="#" class="delete" data-id="'.$salesman->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }
    public function insertSalesman(){
        $vendorGroup = Employee::all();
        $code = MegaTrend::getLastCode('SA','salesman','code');
        $branch = DB::table('branch')->get();
        return view('modules.salesman.insert',compact('code','branch','vendorGroup'));
    }
    public function editSalesman($id){
        $salesman = Salesman::find($id);
        $vendorGroup = Employee::all();
        $branch = DB::table('branch')->get();
        return view('modules.salesman.edit',compact('salesman','branch','vendorGroup'));
    }
    public function detailSalesman($id){
        $salesman = Salesman::find($id);
        return view('modules.salesman.detail',compact('salesman'));
    }
    public function addData(Request $req){
        $salesman = new Salesman();
        $salesman->code = $req->input('code');
        $salesman->name = $req->input('name');
        $salesman->vendor_group_id = $req->input('vendor_group_id');
        $salesman->area_id = $req->input('area_id');
        $salesman->address = $req->input('address');
        $salesman->phone_1 = $req->input('phone_1');
        $salesman->phone_2 = $req->input('phone_2');
        $salesman->email = $req->input('email');
        if($salesman->save()) {
            return Response()->json(
                ['status' => true, 'msg' => 'Data has added!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function updateData(Request $req,$id){
        $salesman = Salesman::where('id',$id)->first();
        $salesman->code = $req->input('code');
        $salesman->name = $req->input('name');
        $salesman->vendor_group_id = $req->input('vendor_group_id');
        $salesman->area_id = $req->input('area_id');
        $salesman->address = $req->input('address');
        $salesman->phone_1 = $req->input('phone_1');
        $salesman->phone_2 = $req->input('phone_2');
        $salesman->email = $req->input('email');
        if($salesman->update()) {
            return Response()->json(
                ['status' => true, 'msg' => 'Data has updated!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function deleteData($id){
        $salesman = Salesman::where('id',$id)->first();
        if($salesman->delete()) {
            return Response()->json(
                ['status' => true, 'msg' => 'Data has deleted!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function getAllData(Request $request){
        $data = DB::table('salesman as a')
        ->join('employee as b','a.employee_id','=','b.id')
        ->where('first_name','like','%'.$request->code.'%')
        ->select('a.*','b.first_name','b.last_name')
        ->get();
        return Response()->json(['msg'=>$data]);
    }
}
