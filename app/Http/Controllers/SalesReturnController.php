<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Delivery;
use App\Helpers\MegaTrend;
use App\PaymentTerm;
use App\Product;
use App\SalesReturn;
use App\Vendor;
use App\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class SalesReturnController extends Controller
{
    //
    public function getData(){
        $sales = DB::table('sales_return')->get();
        return Datatables::of($sales)
            ->addColumn('total', function ($sales) {
                return 'Rp. '.\number_format($sales->total);
            })
            ->addColumn('action', function ($sales) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="'.url('salesReturn/detail/'.$sales->id).'" data-toggle="modal">
                                                <i class="icon-tag"></i> Detail </a>
                                        </li>
                                        <li>
                                            <a href="#" class="delete" data-id="'.$sales->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }
    public function insertSalesReturn(){
        $code = MegaTrend::getLastCode('SR','sales_return','sales_return_no');
        $products = Product::all();
        $warehouse = Warehouse::all();
        $paymentTerm = PaymentTerm::All();
        $shippingMethod=Delivery::all();
        $supplier = Vendor::all();
        $customer = Customer::all();
        return view('modules.sales_return.insert',compact('code','products','warehouse','paymentTerm',
            'purchaseOrder','invoice','shippingMethod','supplier','customer'));
        //return view('modules.purchase_return.insert',compact('code'));
    }
    public function detailSalesReturn($id){
        $salesReturn = SalesReturn::find($id);
        $warehouse = Warehouse::all();
        $vendor = Vendor::all();
        //$supplier = Vendor::all();
        $products = Product::all();
        $shippingMethod=Delivery::all();
        $detail = DB::table('sales_return_detail as a')
            ->join('product as b','b.id','=','a.product_id')
            ->join('unit as c','b.unit_id','=','c.id')
            ->where('sales_return_id','=',$id)
            ->select('a.*','b.code','b.name','b.id as idpod','c.name as unitname')
            ->get();
        return view('modules.sales_return.detail',compact('salesReturn','detail','warehouse','vendor','products','shippingMethod'));
    }
    public function editSalesReturn($id){
        $salesReturn = SalesReturn::find($id);
        $warehouse = Warehouse::all();
        $supplier = Vendor::all();
        $products = Product::all();
        $shippingMethod=Delivery::all();
        $detail = DB::table('sales_return_detail as a')
            ->join('product as b','b.id','=','a.product_id')
            ->join('unit as c','b.unit_id','=','c.id')
            ->where('sales_return_id','=',$id)
            ->select('a.*','b.code','b.name','a.id as idpod','c.name as unitname')
            ->get();

        return view('modules.sales_return.edit',compact('salesReturn','detail','warehouse','supplier','products','shippingMethod'));
    }
    public function addData(Request $req){
        $session = $req->session()->get('user_id');
        $purchase = new SalesReturn();
        $purchase->sales_return_no = $req->input('purchase_return_no');
        $purchase->date = $req->input('date');
        $purchase->warehouse_id=$req->input('warehouse_id');
        //$purchase->vendor_id=$req->input('supplier_id');
        $purchase->delivery_type_id=$req->input('shopping_method');
        $purchase->remarks=$req->input('remark');
        $purchase->customer_id=$req->input('customer_id');
        $purchase->total=$req->input('totalsum');
        $purchase->branch_id = 1;
        $purchase->updated_by=$session['id'];
        $purchase->currency_id=$req->session()->get('currency_id');
        if($purchase->save()) {
            $id = $purchase->id;
            //$id = 1;
            for ($i = 0; $i < count($req->input('productid')); $i++) {
                $productId = $req->input('productid')[$i];
                $qty = $req->input('qty')[$i];
                $price = $req->input('price')[$i];
                $unit = $req->input('unitid')[$i];
                //$pdiscount = $request->input('pdiscount')[$i];
                $totalprice = $req->input('total')[$i];
                DB::table('sales_return_detail')->insert(
                    ['sales_return_id' => $id,'product_id' => $productId,'price'=>$price,'total'=>$totalprice,'qty' => $qty,'unit_id' => $unit,
                        'created_at'=> Carbon::now(),
                        'updated_at'=> Carbon::now(),
                        'updated_by'=>$session['id'],
                        'currency_id'=>$req->session()->get('currency_id')]
                );
            }
            DB::table('sales_return')->where('id',$id)->update(['remarks'=>$req->input('remark')]);
            return Response()->json(
                ['status' => true, 'msg' => 'Data has added!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function deletePR($id){
        $purchase = SalesReturn::find($id);
        if ($purchase->total==0) {
            $purchase->delete();
            return Response()->json(
                ['status' => true, 'msg' => 'Data has deleted!','type'=>'success','title'=>'Purchase']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Product Data Exists !', 'type' => 'warning', 'title' => 'Ops']
            );
        }

    }
    public function addProduct(Request $request){
        $session = $request->session()->get('user_id');
        $id = DB::table('sales_return_detail')->insertGetId(
            [
                'product_id'=>$request->input('product_id'),
                'sales_return_id'=>$request->input('idpo'),
                'total'=>$request->input('total'),
                'qty'=>$request->input('qty'),
                'price'=>$request->input('price'),
                'unit_id'=>$request->input('unit_id'),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'updated_by'=>$session['id'],
                'currency_id'=>$request->session()->get('currency_id')
            ]
        );
        return Response()->json
        (
            [
                'id'=>$id
            ]
        );
    }
    public function updateData(Request $req,$id){
        $session = $req->session()->get('user_id');
        echo json_encode($_POST);
        //exit;
        DB::table('sales_return')
            ->where('id',  $req->input('idpo'))
            ->update(['total' => $req->input('totalsum'),
                        'customer_id'=>$req->input('customer_id'),
                'updated_by'=>$session['id']]);
        echo DB::table('sales_return_detail')
            ->where('id',  $id)
            ->update(
                [
                    'qty' => $req->input('qty'),
                    'product_id' => $req->input('product_id'),
                    'price' => $req->input('price'),
                    'unit_id' => $req->input('unit_id'),
                    'total' => $req->input('total'),
                    'updated_by'=>$session['id']
                ]
            );
    }
    public function updateProduct(Request $request,$id){
        $session = $request->session()->get('user_id');
        DB::table('sales_return')
            ->where('id',  $id)
            ->update(
                [
                    'total' => $request->input('totalsum'),
                    'vendor_id' => $request->input('supplier_id'),
                    'delivery_type_id' => $request->input('shopping_method'),
                    'remarks' => $request->input('remark'),
                    'warehouse_id' => $request->input('warehouse_id'),
                    'updated_by'=>$session['id']
                ]);
    }
    public function getAllData(Request $request){
        $data = SalesReturn::where('id','like','%'.$request->get('sales_return_no').'%')->get();
        return Response()->json(['data'=>$data]);
    }
}
