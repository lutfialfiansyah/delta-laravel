<?php

namespace App\Http\Controllers\COA;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class productCoaController extends Controller
{
    //
    public function getData(){
        $cn = DB::table('product_coa as a')
            ->leftjoin('product as b','a.product_id','=','b.id')
            ->leftjoin('coa_control as c','a.coa_list_id','=','c.id')
            ->leftjoin('coa_list as d','c.coa_list_id','=','d.id')
            ->select('a.*','b.code','b.name as product_name','d.code as coa_id','c.name as coa_name')
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
                                            <a href="#" data-toggle="modal" class="groupedit">
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

        $coalist = $request->input('coa_list');
        foreach($coalist as $key=>$value){
            if($value<>''){
                $data = explode('-',$value);
                DB::table('product_coa')->
                insert([
                    'product_id'=>$request->input('product_id'),
                    'coa_list_id'=>$data[1],
                    'module_index_id'=>$data[0],
                    'created_at'=>Carbon::now(),
                    'updated_by'=>$request->session()->get('user_id')['id']
                ]);
            }
        }
        $save=1;
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
