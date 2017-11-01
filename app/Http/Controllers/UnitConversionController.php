<?php

namespace App\Http\Controllers;

use App\UnitConversion;
use App\Unit;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class UnitConversionController extends Controller
{
    public function getData(Request $request){
        $product = Product::all();
        DB::statement(DB ::raw('set @rownum=0'));
        $productunit = UnitConversion::select([
            DB::raw('@rownum := @rownum + 1 AS rownum'),
            'id',
            'product_id',
            'unit_2_id',
            'unit_2_qty',
            'unit_3_id',
            'unit_3_qty',
            'unit_4_id',
            'unit_4_qty',
            'unit_5_id',
            'unit_5_qty'
        ]);
        /*$data = DB::table('unit_conversion as a')
            ->leftjoin('product as b','a.product_id','=','b.id')
            ->leftjoin('unit as c','d.unit_id','=','c.id')
            ->select('d.*','c.name as unitname')
            ->select('a.*','b.name as productname')
            ->get();*/
        $data = DB::table('unit_conversion as a')
            ->leftjoin('product as b','a.product_id','=','b.id')
            ->leftjoin('unit as c','a.unit_2_id','=','c.id')
            ->leftjoin('unit as d','a.unit_3_id','=','d.id')
            ->leftjoin('unit as e','a.unit_4_id','=','e.id')
            ->leftjoin('unit as f','a.unit_5_id','=','f.id')
            ->select('a.*','b.name as productname',
                'c.name as unitname2',
                'd.name as unitname3',
                'e.name as unitname4',
                'f.name as unitname5'
            )
            ->get();
        return $datatables = Datatables::of($data)
            ->addColumn('action', function ($data) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="'.route('unitconversion.editData',$data->id).'">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#'.$data->id.'" id="trigerdelete" class="prodelete" data-id="'.$data->id.'"">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->addColumn('product_id',function($data){
                return $data->productname;
            })
            ->addColumn('unit_2_id',function ($data){
                return $data->unitname2.' / '.$data->unit_2_qty;
            })
            ->addColumn('unit_3_id',function ($data){
                return $data->unitname3.' / '.$data->unit_3_qty;
            })
            ->addColumn('unit_4_id',function ($data){
                return $data->unitname4.' / '.$data->unit_4_qty;
            })
            ->addColumn('unit_5_id',function ($data){
                return $data->unitname5.' / '.$data->unit_5_qty;
            })
            ->make(true);


    }
    public function editData($id){
        $productunit = UnitConversion::find($id);
        $units = Unit::all();
        $product = Product::all();
        return view('modules.unit_conversion.edit_unitconversion',compact('productunit','units','product'));
    }
    public function deleteData(Request $request,$id){
        $productunit = UnitConversion::find($id);
        $productunit->delete();
        return response()->json(
            ['status'=>true,'title'=>'Unit has deleted','type'=>'success']
        );
        $request->session()->flash('message', 'Success');
        $request->session()->flash('flash_message', 'Unit Conversion has deleted!');
        $request->session()->flash('type', 'success');
        $request->session()->flash('confirm_button', 'btn-success');

    }

    public function insert_unitconversion(){
        $product = Product::all();
        $unit = Unit::all();
        return view('modules.unit_conversion.insert_unitconversion',compact('product','unit'));
    }
    public function addData(Request $request){
        $this->validate($request,[
            'product'=>'required',
            'unit_2_qty'=>'numeric|nullable',
            'unit_3_qty'=>'numeric|nullable',
            'unit_4_qty'=>'numeric|nullable',
            'unit_5_qty'=>'numeric|nullable',
        ]);
        $product = Product::where('id',$request->input('product'))->first();

        $productunit = new UnitConversion();
        $productunit->product_id = $request->input('product');
        $productunit->unit_2_id = $request->input('unit_2_id');
        $productunit->unit_2_qty = $request->input('unit_2_qty');
        $productunit->unit_3_id = $request->input('unit_3_id');
        $productunit->unit_3_qty = $request->input('unit_3_qty');
        $productunit->unit_4_id = $request->input('unit_4_id');
        $productunit->unit_4_qty = $request->input('unit_4_qty');
        $productunit->unit_5_id = $request->input('unit_5_id');
        $productunit->unit_5_qty = $request->input('unit_5_qty');
//        $productunit->save();
        $cek = DB::table('unit_conversion')
            ->select(DB::raw('count(*) as cproduct'))
            ->where('product_id','=',$productunit->product_id = $request->input('product'))
            ->groupBy('product_id')
            ->get()
            ->first();
        if(isset($cek->cproduct)){
            $request->session()->flash('message', 'Success');
            $request->session()->flash('flash_message', 'Unit Conversion Product Already Exist!');
            $request->session()->flash('type', 'warning');
            $request->session()->flash('confirm_button', 'btn-success');
            return redirect()->route('insert.unitconversion');
        }else{
            $productunit->save();
            $request->session()->flash('message', 'Success');
            $request->session()->flash('flash_message', 'Unit Conversion has added!');
            $request->session()->flash('type', 'success');
            $request->session()->flash('confirm_button', 'btn-success');
            return redirect()->route('unitconversion.view');
        }
    }

    public function updateData(Request $request,$id){
        $this->validate($request,[
            'product'=>'required',
            'unit_2_qty'=>'numeric|nullable',
            'unit_3_qty'=>'numeric|nullable',
            'unit_4_qty'=>'numeric|nullable',
            'unit_5_qty'=>'numeric|nullable',
        ]);

        $productunit = UnitConversion::where('id',$id)->first();
        $productunit->product_id = $request->input('product');
        $productunit->unit_2_id = $request->input('unit_2_id');
        $productunit->unit_2_qty = $request->input('unit_2_qty');
        $productunit->unit_3_id = $request->input('unit_3_id');
        $productunit->unit_3_qty = $request->input('unit_3_qty');
        $productunit->unit_4_id = $request->input('unit_4_id');
        $productunit->unit_4_qty = $request->input('unit_4_qty');
        $productunit->unit_5_id = $request->input('unit_5_id');
        $productunit->unit_5_qty = $request->input('unit_5_qty');
        $productunit->update();
        $request->session()->flash('message', 'Success');
        $request->session()->flash('flash_message', 'Unit Conversion has Updated!');
        $request->session()->flash('type', 'success');
        $request->session()->flash('confirm_button', 'btn-success');
        return redirect()->route('unitconversion.view');
    }
    public function getProductUnit($id){
        $subscat = DB::select("select  distinct a.*,b.name from (
select id, unit_id from product
union all
select product_id,unit_2_id from unit_conversion
union all
select product_id,unit_3_id from unit_conversion
union all
select product_id,unit_4_id from unit_conversion
union all
select product_id,unit_5_id from unit_conversion
)a LEFT JOIN unit b
on a.unit_id = b.id where a.id = $id");
        return Response()->json(
            [ 'msg' => $subscat]
        );
    }
    public function getProductUnit2(Request $request){
        $subscat = DB::select("select  distinct a.*,b.name from (
select id, unit_id from product
union all
select product_id,unit_2_id from unit_conversion
union all
select product_id,unit_3_id from unit_conversion
union all
select product_id,unit_4_id from unit_conversion
union all
select product_id,unit_5_id from unit_conversion
)a LEFT JOIN unit b
on a.unit_id = b.id where a.id = ".$request->get('id')." and b.name like '%".$request->get('code')."%'");
        return Response()->json(
            [ 'msg' => $subscat]
        );
    }

    public function cekUnitData(Request $req){
        $u1 = $req->input('u1');
        $u2 = $req->input('u2');
        $u3 = $req->input('u3');
        $unit = DB::table('unit')
            ->select('name','id')
            ->whereNotIn('id',[$u1,$u2,$u3])
            ->get();
        return Response()->json([
            'msg'=>$unit
        ]);
    }

    // public function getAllData(Request $request){
    //     $data = UnitConversion::where('code','like','%'.$request->get('name').'name')->get();
    //     return Response()->json(['data'=>$data]);
    // }

}
