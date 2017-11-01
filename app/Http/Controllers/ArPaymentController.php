<?php

namespace App\Http\Controllers;

use App\ArPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class ArPaymentController extends Controller
{
    //
    public function getData()
    {
        $arPayment = DB::table('ar_Payment as a')
            ->join('customer as c', 'a.customer_id', '=', 'c.id')
            ->select('a.*','c.name','a.subtotal as grand_total')
            ->get();
        return Datatables::of($arPayment)
            ->addColumn('amount',function ($arPayment){
                return 'Rp. '.number_format($arPayment->amount);
            })
            ->addColumn('subtotal',function ($arPayment){
                return 'Rp. '.number_format($arPayment->subtotal);
            })
            ->addColumn('action', function ($arPayment) {
                return
                    '<div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right" role="menu">
                                                        <li>
                                                            <a href="#" data-id="' . $arPayment->id . '"  data-vendor_id="' . $arPayment->customer_id . '"   data-discount="' . $arPayment->discount_total. '" data-total="' . $arPayment->amount . '"  data-subtotal="' . $arPayment->subtotal . '"  data-toggle="modal" class="stockedit">
                                                                <i class="icon-tag"></i> Edit </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-id="' . $arPayment->id . '" class="delete">
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
        $arPayment = new ArPayment();
        $arPayment->customer_id= $vendor;
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
                    DB::table('ar_payment_detail')->insert(
                        [
                            'ar_payment_id'=>$id,
                            'sales_transaction_id'=>$sales_transaction_id,
                            'discount'=>$discount,
                            'total'=>$total
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
        $purchase_no = $request->input('sales_transaction_id');
        $discount =  $request->input('discount');
        $other_cost =  $request->input('other_cost');
        $subtotal =  $request->input('subtotal');
        $arPayment = ArPayment::where('id',$id)->first();
        $arPayment->customer_id= $vendor;
        $arPayment->sales_transaction_id = $purchase_no;
        $arPayment->discount_payment=$discount;
        $arPayment->other_cost = $other_cost;
        $arPayment->subtotal=$subtotal;
        $arPayment->total=$request->input('total');
        $arPayment->updated_by = $request->session()->get('user_id')['id'];
        $arPayment->branch_id = $request->session()->get('branch_id');
        $arPayment->currency_id= $request->session()->get('currency_id');
        if($arPayment->update()) {
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
        $arPayment = ArPayment::where('id',$id)->first();
        if($arPayment->delete()) {
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
