<?php

namespace App\Http\Controllers;

use App\CreditNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CreditNoteController extends Controller
{
    //
    public function getData(){
        $cn = CreditNote::all();
        return Datatables::of($cn)
            ->addColumn('action', function ($cn) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#" data-code="'.$cn->code.'" data-id="'.$cn->id.'" data-name="'.$cn->name.'" data-toggle="modal" class="groupedit">
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
    public function addData(Request $request){
        $name = $request->input('groupname');
        $cek = DB::table('cn_type')
            ->select(DB::raw('count(*) as ar'))
            ->where('name','=',$name)
            ->groupBy('id')
            ->get()
            ->first();
        //echo  json_encode($cek);
        if(isset($cek->cproduct)){
            return Response()->json(
                ['status' => true, 'msg' => 'Data already exists!', 'type' => 'warning', 'title' => 'Ops']
            );
        }else{
            $ap = new CreditNote();
            $ap->name=$name;
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
        $vendor = $request->input('groupname');
        $ap = CreditNote::where('id',$id)->first();
        $ap->name=$vendor;
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
            $save = DB::table('cn_type')->where('id', '=', $id)->delete();
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
