<?php

namespace App\Http\Controllers\COA;

use App\Models\COA\CoaList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CoaListController extends Controller
{
    //
    public function getData(){
        $coalist  = DB::table('coa_list as a')
            ->join('coa_type as b','a.coa_type_id','=','b.id')
            ->leftjoin('coa_list as c','a.coa_parent_id','=','c.id')
            ->select('a.*','b.name as type','c.name as parent')
            ->get();
        return Datatables::of($coalist)
            ->addColumn('action', function ($coalist) {
                return
                    '<div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right" role="menu">
                                                        <li>
                                                            <a href="#" data-id="' . $coalist->id . '"
                                                               data-type ="'.$coalist->coa_type_id.'"
                                                               data-name ="'.$coalist->name.'"
                                                               data-code ="'.$coalist->code.'"
                                                               data-type_name ="'.$coalist->type.'" data-toggle="modal" class="stockedit">
                                                                <i class="icon-tag"></i> Edit </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-id="' . $coalist->id . '" class="delete">
                                                                <i class="icon-docs"></i> Delete </a>
                                                        </li>
                                                    </ul>
                                                </div>';
            })
            ->make(true);
    }
    public function addData(Request $req){
        $code = $req->input('code');
        $name = $req->input('name');
        $type = $req->input('type');
        $currency = $req->input('currency');
        $balance_beginning = $req->input('balance_beginning');
        $date_balance_beginning = $req->input('date_balance_beginning');

        $coaList = new CoaList();
        $coaList->code = $code;
        $coaList->name = $name;
        $coaList->coa_type_id=$type;
        $coaList->balance_beginning = $balance_beginning;
        $coaList->date_balance_beginning = $date_balance_beginning;

        if($coaList->save()){
            return Response()->json(
                ['status' => true, 'msg' => 'Data has added!','type'=>'success','title'=>'Success']
            );
        }else {
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function getAllData(Request $request){
        $data = CoaList::where('code','like','%'.$request->get('name').'%')->get();
        return Response()->json(['data'=>$data]);
    }
}
