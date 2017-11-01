<?php

namespace App\Http\Controllers;

use App\DebitNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class DebitNoteController extends Controller
{
    //
    public function getData(){
        $cn = DebitNote::all();
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
        $cek = DB::table('dn_type')
            ->select(DB::raw('count(*) as dn'))
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
            $ap = new DebitNote();
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
        $ap = DebitNote::where('id',$id)->first();
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
            $save = DB::table('dn_type')->where('id', '=', $id)->delete();
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
    public function getDataDn(){
        $cnTransaction = DB::table('dn_detail as a')
            ->leftjoin('vendor as b','a.vendor_id','=','b.id')
            ->select('a.*','b.name','b.code','total as balance')
            ->get();
        return Datatables::of($cnTransaction)
            ->addColumn('total', function ($cnTransaction) {
                return 'Rp. '.number_format($cnTransaction->total);
            })
            ->addColumn('balance', function ($cnTransaction) {
                return 'Rp. '.number_format($cnTransaction->balance);
            })
            ->addColumn('action', function ($cnTransaction) {
                return
                    '<div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-left" role="menu">
                                                        <li>
                                                            <a href="#" data-toggle="modal" class="stockedit">
                                                                <i class="icon-tag"></i> Edit </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-id="' . $cnTransaction->id . '" class="delete">
                                                                <i class="icon-docs"></i> Delete </a>
                                                        </li>
                                                    </ul>
                                                </div>';
            })
            ->make(true);
    }
    public function addDataDn(Request $request){
        $save = DB::table('dn_detail')->insert([
            'vendor_id'=>$request->input('vendor_id'),
            'total'=>$request->input('total'),
            'dn_type_id'=>'1',
            'remarks'=>$request->input('remarks')
        ]);
        if($save){
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
