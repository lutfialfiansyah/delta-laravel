<?php

namespace App\Http\Controllers;

use App\Helpers\MegaTrend;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\PaymentTerm;
use App\Purchase;
use App\Delivery;
use App\PurchaseReturn;
use App\Vendor;
use App\Warehouse;

class PurchaseReturnController extends Controller
{
    //
    public function getData(){
        $purchase = DB::table('purchase_return')->get();
        return Datatables::of($purchase)
            ->addColumn('total', function ($purchase) {
                return 'Rp. '.\number_format($purchase->total);
            })
            ->addColumn('action', function ($purchase) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="'.url('purchaseReturn/detail/'.$purchase->id).'" data-toggle="modal">
                                                <i class="icon-tag"></i> Detail </a>
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
    public function insertPurchaseReturn(){
        $branch = Branch::all();
        $code = MegaTrend::getLastCode('PR','purchase_return','purchase_return_no');
        $products = Product::all();
        $warehouse = Warehouse::all();
        $paymentTerm = PaymentTerm::All();
        $shippingMethod=Delivery::all();
        $supplier = Vendor::all();
        $branch = DB::table('branch')->select('id','description')->get();
        return view('modules.purchase_return.insert',compact('code','branch','products','warehouse','paymentTerm',
            'purchaseOrder','invoice','shippingMethod','supplier'));
        //return view('modules.purchase_return.insert',compact('code'));
    }
    public function detailPurchaseReturn($id){
    	$purchaseReturn = PurchaseReturn::find($id);
    	$warehouse = Warehouse::all();
    	$vendor = Vendor::all();
    	//$supplier = Vendor::all();
    	$products = Product::all();
    	 $shippingMethod=Delivery::all();
        $detail = DB::table('purchase_return_detail as a')
            ->join('product as b','b.id','=','a.product_id')
            ->join('unit as c','b.unit_id','=','c.id')
            ->where('purchase_return_id','=',$id)
            ->select('a.*','b.code','b.name','b.id as idpod','c.name as unitname')
            ->get();
        return view('modules.purchase_return.detail',compact('purchaseReturn','detail','warehouse','vendor','products','shippingMethod'));
    }
    public function editpurchaseReturn($id){
        $purchaseReturn = PurchaseReturn::find($id);
        $warehouse = Warehouse::all();
        $supplier = Vendor::all();
        $products = Product::all();
        $shippingMethod=Delivery::all();
        $detail = DB::table('purchase_return_detail as a')
            ->join('product as b','b.id','=','a.product_id')
            ->join('unit as c','b.unit_id','=','c.id')
            ->where('purchase_return_id','=',$id)
            ->select('a.*','b.code','b.name','a.id as idpod','c.name as unitname')
            ->get();

        return view('modules.purchase_return.edit',compact('purchaseReturn','detail','warehouse','supplier','products','shippingMethod'));
    }
    public function addData(Request $req){
    	$purchase = new PurchaseReturn();
        $purchase->purchase_return_no = $req->input('purchase_return_no');
        $purchase->date = $req->input('date');
        $purchase->warehouse_id=$req->input('warehouse_id');
        $purchase->vendor_id=$req->input('supplier_id');
        $purchase->delivery_type_id=$req->input('shopping_method');
        $purchase->remarks=$req->input('remark');
        $purchase->total=$req->input('totalsum');
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
                DB::table('purchase_return_detail')->insert(
                    ['purchase_return_id' => $id,'product_id' => $productId,'price'=>$price,'total'=>$totalprice,'qty' => $qty,'unit_id' => $unit,
                        'created_at'=> Carbon::now(),
                        'updated_at'=> Carbon::now()]
                );
            }
            DB::table('purchase_return')->where('id',$id)->update(['remarks'=>$req->input('remarks')]);
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
        $purchase = PurchaseReturn::find($id);
        if ($purchase->total==0) {
            $purchase->delete();
            return Response()->json(
                ['status' => true, 'msg' => 'Data Purchase Return has deleted!','type'=>'success','title'=>'Purchase']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Product Data Exists !', 'type' => 'warning', 'title' => 'Ops']
            );
        }

    }
    public function addProduct(Request $request){
        $id = DB::table('purchase_return_detail')->insertGetId(
            [
                'product_id'=>$request->input('product_id'),
                'purchase_return_id'=>$request->input('idpo'),
                'total'=>$request->input('total'),
                'qty'=>$request->input('qty'),
                'price'=>$request->input('price'),
                'unit_id'=>$request->input('unit_id'),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
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
        echo json_encode($_POST);
        //exit;
        DB::table('purchase_return')
            ->where('id',  $req->input('idpo'))
            ->update(['total' => $req->input('totalsum')]);
        echo DB::table('purchase_return_detail')
            ->where('id',  $id)
            ->update(
                [
                    'qty' => $req->input('qty'),
                    'product_id' => $req->input('product_id'),
                    'price' => $req->input('price'),
                    'unit_id' => $req->input('unit_id'),
                    'total' => $req->input('total')
                ]
            );
    }
    public function updateProduct(Request $request,$id){
        DB::table('purchase_return')
            ->where('id',  $id)
            ->update(
                [
                    'total' => $request->input('totalsum'),
                    'vendor_id' => $request->input('supplier_id'),
                    'delivery_type_id' => $request->input('shopping_method'),
                    'remarks' => $request->input('remark'),
                    'warehouse_id' => $request->input('warehouse_id')
                ]);
    }
    public function getAllData(Request $request){
        $data = PurchaseReturn::where('id','like','%'.$request->get('purchase_return_no').'%')->get();
        return Response()->json(['data'=>$data]);
    }
}
