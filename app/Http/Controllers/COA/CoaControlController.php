<?php

namespace App\Http\Controllers\COA;

use App\Models\COA\CoaControl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CoaControlController extends Controller
{
    //
    public function getData(){
        $cn = DB::table('coa_control as a')
        ->join('coa_list as b','a.coa_list_id','b.id')
            ->select("a.*","b.code as coa_code","b.name as coa_name")
        ->get();
        return Datatables::of($cn)
            ->addColumn('action', function ($cn) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#"  data-coa_name="'.$cn->coa_name.'" data-code="'.$cn->coa_code.'" data-coa_list_id="'.$cn->coa_list_id.'" data-id="'.$cn->id.'" data-name="'.$cn->name.'" data-toggle="modal" class="groupedit">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#" data-id="'.$cn->id.'" class="delete">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }
    public function addData(Request $req){
        $coaControl = new CoaControl();
        $coaControl->name = $req->input('groupname');
        $coaControl->coa_list_id = $req->input('coa_list_id');
        $coaControl->debit_credit = $req->input('credit');

        if($coaControl->save()){
            return Response()->json(
                ['status' => true, 'msg' => 'Data has added!','type'=>'success','title'=>'Success']
            );
        }else {
            return Response()->json(
                ['status' => true, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function updateData(Request $req,$id){
        $coaControl = CoaControl::where('id',$id);
        $coaControl->name = $req->input('groupname');
        $coaControl->coa_list_id = $req->input('coa_list_id');
        $coaControl->debit_credit = $req->input('credit');
        if($coaControl->update()){
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
