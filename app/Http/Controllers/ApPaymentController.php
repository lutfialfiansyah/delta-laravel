<?php

namespace App\Http\Controllers;

use App\ApPayment;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class ApPaymentController extends Controller
{
    //
    public function getData()
    {
        $apPayment = DB::table('ap_payment as a')
            ->join('vendor as c', 'a.vendor_id', '=', 'c.id')
            ->select('a.*','c.name','a.subtotal as grand_total')
            ->get();
        return Datatables::of($apPayment)
            ->addColumn('amount',function ($apPayment){
                return 'Rp. '.number_format($apPayment->amount);
            })
            ->addColumn('subtotal',function ($apPayment){
                return 'Rp. '.number_format($apPayment->subtotal);
            })
            ->addColumn('action', function ($apPayment) {
                return
                    '<div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right" role="menu">
                                                        <li>
                                                            <a href="#" data-id="' . $apPayment->id . '"  data-vendor_id="' . $apPayment->vendor_id . '"      data-discount="' . $apPayment->discount_total . '" data-total="' . $apPayment->subtotal . '"  data-subtotal="' . $apPayment->grand_total . '"  data-toggle="modal" class="stockedit">
                                                                <i class="icon-tag"></i> Edit </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-id="' . $apPayment->id . '" class="delete">
                                                                <i class="icon-docs"></i> Delete </a>
                                                        </li>
                                                    </ul>
                                                </div>';
            })
            ->make(true);
    }
    public function addData(Request $request){
        $data = implode(",",$request->input('sales_transaction_id'));
        $edata = explode(",",$data);
        $discount_total =  $request->input('discount_total');
        $coa_bank_id =  $request->input('bank');
        $grand_total =  $request->input('grand_total');
        $difference =  $request->input('difference');
        $amount =  $request->input('amount');
        $vendor =  $request->input('vendor_id');
        $arPayment = new ApPayment();
        $arPayment->vendor_id= $vendor;
        $arPayment->coa_bank_id= $coa_bank_id;
        $arPayment->discount_total=$discount_total;
        $arPayment->subtotal=$grand_total;
        $arPayment->amount=$amount;
        $arPayment->difference=$difference;
        $arPayment->updated_by = $request->session()->get('user_id')['id'];
        $arPayment->branch_id = $request->session()->get('branch_id');
        $arPayment->currency_id= $request->session()->get('currency_id');
        if($arPayment->save()) {
            $id = $arPayment->id;
            for($i=0;$i<count($request->input('sales_transaction_id'));$i++){
                $ids=$edata[$i];
                $sales_transaction_id=$request->input('sales_transaction_id')[$ids];
                $discount = $request->input('discount')[$ids];
                $total = $request->input('total')[$ids];
                DB::table('ap_payment_detail')->insert(
                    [
                        'ap_payment_id'=>$id,
                        'purchase_transaction_id'=>$sales_transaction_id,
                        'discount'=>$discount,
                        'total'=>$total,
                        'updated_by'=>$request->session()->get('user_id')['id'],
                        'currency_id'=>$request->session()->get('currency_id')
                    ]
                );
            }
            return Response()->json(
                ['status' => true, 'msg' => 'Data has added!','type'=>'success','title'=>'Success']
            );
        }else {
            return Response()->json(
                ['status' => true, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function updateData(Request $request, $id){
        $vendor = $request->input('vendor_id');
        $purchase_no = $request->input('purchase_transaction_id');
        $discount =  $request->input('discount');
        $other_cost =  $request->input('other_cost');
        $subtotal =  $request->input('subtotal');
        $total =  $request->input('total');
        $apPayment = ApPayment::where('id',$id)->first();
        $apPayment->vendor_id= $vendor;
        $apPayment->purchase_transaction_id = $purchase_no;
        $apPayment->discount=$discount;
        $apPayment->other_cost = $other_cost;
        $apPayment->sub_total=$subtotal;
        $apPayment->grand_total=$total;
        $apPayment->updated_by = $request->session()->get('user_id')['id'];
        $apPayment->branch_id = $request->session()->get('branch_id');
        $apPayment->currency_id= $request->session()->get('currency_id');
        if($apPayment->update()) {
            return Response()->json(
                ['status' => true, 'msg' => 'Data has updated!','type'=>'success','title'=>'Success']
            );
        }else {
            return Response()->json(
                ['status' => true, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function deleteData($id){
        $apPayment = ApPayment::where('id',$id)->first();
        if($apPayment->delete()) {
            return Response()->json(
                ['status' => true, 'msg' => 'Data has deleted!','type'=>'success','title'=>'Success']
            );
        }else {
            return Response()->json(
                ['status' => true, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
}
