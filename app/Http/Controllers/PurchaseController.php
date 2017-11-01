<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Delivery;
use App\Helpers\MegaTrend;
use App\PaymentTerm;
use App\Product;
use App\Purchase;
use App\PurchaseOrder;
use App\Vendor;
use App\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class PurchaseController extends Controller
{
    //
    public function getData(){
        $purchase = DB::table('purchase_transaction')->get();
        return Datatables::of($purchase)
            ->addColumn('sub_total', function ($purchase) {
                return number_format($purchase->sub_total,2);
            })
            ->addColumn('grand_total', function ($purchase) {
                return number_format($purchase->grand_total,2);
            })
            ->addColumn('action', function ($purchase) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="'.url('purchase/detail/'.$purchase->id).'" data-toggle="modal">
                                                <i class="icon-tag"></i> Detail </a>
                                        </li>
                                        <li>
                                            <a target="_blank" href="'.url('jsReport/'.$purchase->id).'" data-toggle="modal">
                                                <i class="icon-tag"></i> PDF </a>
                                        </li>
                                        <li>
                                            <a href="#" class="delete" data-id="'.$purchase->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }
    public function insertPurchase(){
        $code = MegaTrend::getLastCode("PT",'purchase_transaction','purchase_transaction_no');
        //$invoice = MegaTrend::getLastCode("INV",'purchase','supplier_invoice_no');
        $products = Product::all();
        $warehouse = Warehouse::all();
        $paymentTerm = PaymentTerm::All();
        $purchaseOrder = PurchaseOrder::All();
        $shippingMethod=Delivery::all();
        $supplier = Vendor::all();
        $branch = Branch::all();
        $tax = DB::table('tax')->get();
        return view('modules.purchase.insert',compact('branch','code','products','warehouse','paymentTerm',
            'purchaseOrder','invoice','shippingMethod','supplier','tax'));
    }
    public function editPurchase($id){
        $purchase = Purchase::find($id);
        //$invoice = MegaTrend::getLastCode("INV",'purchase','supplier_invoice_no');
        $products = Product::all();
        $warehouse = Warehouse::all();
        $paymentTerm = PaymentTerm::All();
        $purchaseOrder = PurchaseOrder::All();
        $shippingMethod=Delivery::all();
        $supplier = Vendor::all();
        $detail = DB::table('purchase_transaction_detail as a')
            ->join('product as b','b.id','=','a.product_id')
            ->where('purchase_id','=',$id)
            ->select('a.*','b.code','b.name','a.id as idpd','a.cogs as total')
            ->get();
        return view('modules.purchase.edit',compact('code','products','warehouse','paymentTerm',
            'purchaseOrder','invoice','shippingMethod','supplier','purchase','detail'));
    }
    public function detailPurchase($id){
        $purchase = Purchase::find($id);
        $detail = DB::table('purchase_transaction_detail as a')
            ->join('product as b','b.id','=','a.product_id')
            ->where('purchase_id','=',$id)
            ->select('a.*','b.code','b.name','a.id as idpd','a.cogs as total')
            ->get();
        return view('modules.purchase.detail',compact('purchase','detail'));
    }
    public function updateData(Request $request,$id)
    {
        $purchase = Purchase::where('id',$request->input('idpo'))->first();
        $purchase->warehouse_id = $request->input('warehouse_id');
        $purchase->total = $request->input('totalsum');
        $purchase->delivery_type_id = $request->input('shopping_method');
        $purchase->shipping_date = $request->input('shipping_date');
        $purchase->payment_term_id = $request->input('payment_term_id');
        $purchase->shipping_date = $request->input('shipping_date');
        $purchase->vendor_invoice_no=$request->input('supplier_inv');
        $purchase->purchase_order_id = $request->input('purchase_order_id');
        $purchase->updated_at = Carbon::now();
        $purchase->update();
        DB::table('purchase_transaction_detail')
            ->where('id',  $id)
            ->update(
                [
                    'qty' => $request->input('qty'),
                    'product_id' => $request->input('product_id'),
                    'price' => $request->input('price'),
                    'total' => $request->input('total'),
                    'discount' => $request->input('discount'),
                    'percent_discount' => $request->input('pdiscount')
                ]
            );
    }
    public function addProduct(Request $request){
        $id = DB::table('purchase_transaction_detail')->insertGetId(
            [
                'product_id'=>$request->input('product_id'),
                'purchase_id'=>$request->input('idpo'),
                'cogs'=>$request->input('total'),
                'qty'=>$request->input('qty'),
                'price'=>$request->input('price'),
                'discount'=>$request->input('discount'),
                'percent_discount'=>$request->input('pdiscount'),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]
        );
        return Response()->json(
            [
                'id'=>$id
            ]);
    }
    public function addData(Request $request){
        //print_r($_POST);
        //exit;
        $session = $request->session()->get('user_id');
        $cost = $request->input('othercost');
        $discount = $request->input('otherdiscount');
        $tsumqty = $request->input('tsumqty');
        $add_cost = ($cost-$discount)/$tsumqty;
        $purchase = new Purchase();
        $purchase->purchase_transaction_no = $request->input('sales_transaction_no');
        $purchase->date = $request->input('date');
        $purchase->warehouse_id=$request->input('werehouse_id');
        $purchase->purchase_order_id=$request->input('sales_order_id');
        $purchase->vendor_id=$request->input('customer_id');
        $purchase->vendor_invoice_no=$request->input('vendor_no');
        $purchase->delivery_type_id=$request->input('delivery_type_id');
       //$purchase->shipping_date=$request->input('shipping_date');
        $purchase->grand_total=$request->input('subtotal_after_tax');
        $purchase->grand_total_w_tax=$request->input('grandtotal');
        $purchase->additional_discount=$request->input('otherdiscount');
        $purchase->additional_cost=$request->input('othercost');
        $purchase->payment_term_id=$request->input('term_of_payment_id');
        $purchase->sub_total=$request->input('subtotal_before_tax');
        $purchase->updated_by = $session['id'];
        $purchase->currency_id = $request->session()->get('currency_id');
        $purchase->branch_id=$request->input('branch');
        $purchase->tax_subtotal = $request->input('tax');
        if($purchase->save()) {
            $id = $purchase->id;
            //$id=1;
            for ($i = 0; $i < count($request->input('productid')); $i++) {
                $productId = $request->input('productid')[$i];
                $qty = $request->input('qty')[$i];
                $unit = $request->input('unit')[$i];
                $price = $request->input('price')[$i];
                $discount = 0;
                $pdiscount = 0;
                $totalprice = $request->input('total')[$i];
                $tax = $request->input('taxid')[$i];
                $ttax = $request->input('totaltax')[$i];
                DB::table('purchase_transaction_detail')->insert(
                    ['purchase_id' => $id,'product_id' => $productId,'price'=>$price,'cogs'=>$totalprice,'qty' => $qty,'discount' => $discount,'percent_discount' => $pdiscount,
                        'created_at'=> Carbon::now(),
                        'updated_at'=> Carbon::now(),
                        'unit_id'=>$unit,
                        'auto_add'=> $add_cost,
                        'updated_by'=>$session['id'],
                        'total'=>$totalprice,
                        'tax_id'=>$tax,
                        'tax_total'=>$totalprice*($tax/100),
                        'currency_id'=>$request->session()->get('currency_id')]
                );
            }
            DB::table('purchase_transaction')->where('id',$id)->update(['remarks'=>$request->input('remarks')]);
            return Response()->json(
                ['status' => true, 'msg' => 'Data has added!','type'=>'success','title'=>'Success']
            );
        }else {
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function updatePrice(Request $request,$id){
        $p = Purchase::where('id',$id)->first();
        $p->warehouse_id = $request->input('warehouse_id');
        $p->payment_term_id =  $request->input('payment_term_id');
        $p->vendor_id =  $request->input('supplier_id');
        $p->delivery_type_id =  $request->input('delivery_id');
        $p->sub_total =  $request->input('sumtotal');
        $p->vendor_invoice_no =  $request->input('supplier_inv');
        //$p->shipping_date =  $request->input('shipping_date');
        $p->purchase_order_id =  $request->input('purchase_order_id');
        //echo json_encode($p);
        $p->grand_total=$request->input('grand_total');
        $p->additional_discount=$request->input('additional_discount');
        $p->additional_cost=$request->input('additional_cost');
        $p->tax_subtotal = $request->input('tsumtotaltax');
        $p->grand_total_w_tax = $request->input('grand_total_w_tax');
        $p->update();
    }
    public function deleteProduct($id){
        DB::table('purchase_detail')->delete([
            'id'=>$id]);
        return Response()->json(
                ['status' => true, 'msg' => 'Data has deleted!','type'=>'success','title'=>'Purchase detail product']
        );
    }
    public function deleteData($id){
        $purchase = Purchase::find($id);
        if ($purchase->total==0) {
            $purchase->delete();
            return Response()->json(
                ['status' => true, 'msg' => 'Data Purchase has deleted!','type'=>'success','title'=>'Purchase']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Product Data Exists !', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function getPurchaseNoByVendor($id){
        $purchaseNo = DB::table('purchase_transaction as a')
            ->leftjoin('ap_payment_balance as b','a.id','=','b.id')
            ->where('vendor_id',$id)
            ->where('b.balance',"<>",'0')
        ->get();
        return Response()->json(
            ['msg'=>$purchaseNo]
        );
    }

}
