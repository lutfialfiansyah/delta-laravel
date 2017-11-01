<?php

namespace App\Http\Controllers;

use App\Helpers\MegaTrend;
use App\PaymentTerm;
use App\Vendor;
use App\VendorGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class VendorController extends Controller
{
    public function getData(){
//        $vendors = Vendor::all();
        $data = DB::table('vendor as a')
            ->leftjoin('vendor_group as b','a.vendor_group_id','=','b.id')
            ->leftjoin('payment_term as c','a.payment_term_id','=','c.id')
            ->select('a.*','b.name as vendorgroupname',
                'c.name as paymentname'
            )
            ->get();
        return $datatables = Datatables::of($data)
//            return Datatables::of($data)
                ->editColumn('phone_1',function($data){
                    return
                        $data->phone_1.' /<br> '.$data->phone_2;
                })
                ->addColumn('action', function ($data) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="'.route('vendors.editData',$data->id).'">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#'.$data->id.'" id="trigerdelete" class="prodelete" data-id="'.$data->id.'"">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
                ->addColumn('vendor_group_id',function($data){
                    return $data->vendorgroupname;
                })
                ->addColumn('payment_term_id',function($data){
                    return $data->paymentname;
                })
            ->make(true);
    }
    public function insertVendor(){
        $code = MegaTrend::getLastCode('VR','vendor','code');
        $vendorgroup = VendorGroup::all();
        $pay = PaymentTerm::all();
        return view('modules.vendors.insert_vendors',compact('code','vendorgroup','pay'));
    }
    public function addData(Request $request){
        $this->validate($request,[
            'code'=>'required',
            'name'=>'required|max:50',
            'email'=>'required|email',
        ]);

        $vendors = new Vendor();
        $vendors->code = $request->input('code');
        $vendors->name = $request->input('name');
        $vendors->vendor_group_id = $request->input('vendor_group_id');
        $vendors->payment_term_id = $request->input('payment_term_id');
        $vendors->area_id = $request->input('area_id');
        $vendors->address = $request->input('address');
        $vendors->phone_1 = $request->input('phone_1');
        $vendors->phone_2 = $request->input('phone_2');
        $vendors->email = $request->input('email');

        $vendors->save();
        $request->session()->flash('message', 'Success');
        $request->session()->flash('flash_message', 'Vendor has added!');
        $request->session()->flash('type', 'success');
        $request->session()->flash('confirm_button', 'btn-success');
        return redirect()->route('vendors.view');
    }

    public function editData($id){
        $vendors = Vendor::find($id);
        $vendorgroup = VendorGroup::all();
        $pay = PaymentTerm::all();
        return view('modules.vendors.edit_vendors',compact('vendors','vendorgroup','pay'));
    }
    public function deleteData(Request $request,$id){
        $vendors = Vendor::find($id);
        $vendors->delete();
        return response()->json(
            ['status'=>true,'title'=>'Vendor has deleted','type'=>'success']
        );
        $request->session()->flash('message', 'Success');
        $request->session()->flash('flash_message', 'Vendor has deleted!');
        $request->session()->flash('type', 'success');
        $request->session()->flash('confirm_button', 'btn-success');

    }
    public function updateData(Request $request,$id){
        $this->validate($request,[
            'code'=>'required',
            'name'=>'required|max:50',
            'email'=>'required|email',
        ]);

        $vendors = Vendor::where('id',$id)->first();
        $vendors->code = $request->input('code');
        $vendors->name = $request->input('name');
        $vendors->vendor_group_id = $request->input('vendor_group_id');
        $vendors->payment_term_id = $request->input('payment_term_id');
        $vendors->area_id = $request->input('area_id');
        $vendors->address = $request->input('address');
        $vendors->phone_1 = $request->input('phone_1');
        $vendors->phone_2 = $request->input('phone_2');
        $vendors->email = $request->input('email');
        $vendors->update();

        $request->session()->flash('message', 'Success');
        $request->session()->flash('flash_message', 'Vendor has Updated!');
        $request->session()->flash('type', 'success');
        $request->session()->flash('confirm_button', 'btn-success');
        return redirect()->route('vendors.view');
    }
    public function getPaymentTerm($id){
        $subscat = DB::table('vendor as a')
            ->join('payment_term as b','b.id','=','a.payment_term_id')
            ->select('b.*')
            ->where('a.id','=',$id)
            ->get()
            ->first();
        //echo json_encode($subscat);
        return Response()->json(
            [ 'msg' => $subscat]
        );
    }
    public function getPaymentTermId($id){
        $subscat = DB::table('payment_term as a')
            ->select('a.*')
            ->where('a.id','=',$id)
            ->get()
            ->first();
        //echo json_encode($subscat);
        return Response()->json(
            [ 'msg' => $subscat]
        );
    }
    public function getAllData(Request $request){
        $data=Vendor::where('code','like','%'.$request->input('code').'%')->
        orwhere('name','like','%'.$request->input('code').'%')
        ->get();
        return Response()->json(
          ['msg'=>$data]
        );
    }
}
