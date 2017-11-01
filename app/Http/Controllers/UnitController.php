<?php

namespace App\Http\Controllers;

use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\New_;
use Yajra\Datatables\Datatables;

class UnitController extends Controller
{
    public function getData(Request $request)
    {
        DB::statement(DB ::raw('set @rownum=0'));
        $unit = Unit::select([
            DB::raw('@rownum := @rownum + 1 AS rownum'),
            'id', 'name', 'created_at', 'updated_at'
        ]);
        $datatables = Datatables::of($unit);
        if ($keyword = $request->get('search')['value']){
            $datatables->filterColumn('rownum','whereRaw', '@rownum + 1 like ?', ["%keyword%"]);
        }
        return $datatables
            ->addColumn('action', function ($unit) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#" id="trigerupdate" class="unitedit" data-id="'.$unit->id.'" data-name="'.$unit->name.'">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#" id="trigerdelete" class="unitdelete" data-id="'.$unit->id.'"">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);

    }

    public function addData(Request $request){
        $unit = New Unit();
        $unit->name = $request->input('name');
        $unit->created_at = Carbon::now('Asia/Jakarta');
        $cek = DB::table('unit')
            ->select(DB::raw('count(*) as cname'))
            ->where('name','=',$request->input('name'))
            ->groupBy('name')
            ->get()
            ->first();
        if(isset($cek->cname)){
            $request->session()->flash('message', 'Warning');
            $request->session()->flash('flash_message', 'Unit Data Already Exist!');
            $request->session()->flash('type', 'warning');
            $request->session()->flash('confirm_button', 'btn-success');
            return redirect()->route('unit.view');
        }else{
            if($unit->save()) {
                $request->session()->flash('message', 'Success');
                $request->session()->flash('flash_message', 'Unit has added!');
                $request->session()->flash('type', 'success');
                $request->session()->flash('confirm_button', 'btn-success');
                return redirect()->route('unit.view');
            }else {
                $request->session()->flash('message', 'Success');
                $request->session()->flash('flash_message', 'Unit has added!');
                $request->session()->flash('type', 'warning');
                $request->session()->flash('confirm_button', 'btn-success');
                return redirect()->route('unit.view');
            }
        }
    }
    public function updateData(Request $request, $id){
        $unit = Unit::find($id);
        $unit->name = $request->input('name');
        $unit->updated_at = Carbon::now('Asia/Jakarta');
        $unit->save();

        $request->session()->flash('message', 'Success');
        $request->session()->flash('flash_message', 'Unit has updated!');
        $request->session()->flash('type', 'success');
        $request->session()->flash('confirm_button', 'btn-success');
        return redirect()->route('unit.view');
    }
    public function deleteData(Request $request, $id){
        $unit = Unit::find($id);
        $unit->delete();

        $request->session()->flash('message', 'Success');
        $request->session()->flash('flash_message', 'Unit has deleted!');
        $request->session()->flash('type', 'success');
        $request->session()->flash('confirm_button', 'btn-success');
        return redirect()->route('unit.view');
    }
    public function getAllData(Request $request){
        $data = Unit::where('id','like','%'.$request->get('name').'%')->get();
        return Response()->json(['data'=>$data]);
    }
}
