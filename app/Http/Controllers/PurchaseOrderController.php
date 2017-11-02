<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Helpers\MegaTrend;
use App\Product;
use App\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class PurchaseOrderController extends Controller
{
    //
    public function getData()
    {
        $po = PurchaseOrder::all();
        return Datatables::of($po)
            ->addColumn('vendor_name', function ($po) {
                return $po->vendor->name;
            })
            ->addColumn('grand_total_w_tax', function ($po) {
                return \number_format($po->grand_total_w_tax);
            })
            ->addColumn('updated_by', function ($po) {
                return $po->getUser->getEmployee->first_name;
            })
            ->addColumn('action', function ($po) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="purchaseOrder/detail/'.$po->id.'" data-toggle="modal">
                                                <i class="icon-tag"></i> Detail </a>
                                        </li>
                                        <li>
                                            <a href="#" class="delete" data-id="'.$po->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);

    }
    public function insertPurchaseOrder(){
        $code = MegaTrend::getLastCode('PO','purchase_order','purchase_order_no');
        $products = Product::all();
        $branch = Branch::all();
        return view('modules.purchase_order.insert',compact('code','products','branch'));
    }
    public function detailPurchaseOrder($id){
        $purchaseOrder = purchaseOrder::find($id);
        $detail = DB::table('purchase_order_detail as a')
            ->join('product as b','b.id','=','a.product_id')
            ->join('unit as c','c.id','=','a.unit_id')
            ->where('purchase_order_id','=',$id)
            ->select('a.*','b.code','b.name','a.id as idpod','c.name as unitname')
            ->get();
        return view('modules.purchase_order.detail',compact('purchaseOrder','detail'));
    }
    public function editPurchaseOrder($id){
        $products = Product::all();
        $branch = Branch::all();
        $purchaseOrder = purchaseOrder::find($id);
        $detail = DB::table('purchase_order_detail as a')
            ->join('product as b','b.id','=','a.product_id')
            ->join('unit as c','c.id','=','a.unit_id')
            ->where('purchase_order_id','=',$id)
            ->wherenull('a.deleted_at')
            ->select('a.*','b.code','b.name','a.id as idpod','c.name as unitname')
            ->get();

        return view('modules.purchase_order.edit',compact('branch','products','purchaseOrder','detail'));
    }
    public function addProduct(Request $request){
        $session = $request->session()->get('user_id');
      $id = DB::table('purchase_order_detail')->insertGetId(
            [
                'product_id'=>$request->input('product_id'),
                'purchase_order_id'=>$request->input('idpo'),
                'total'=>$request->input('total'),
                'qty'=>$request->input('qty'),
                'unit_id'=>$request->input('unit_id'),
                'price'=>$request->input('price'),
                'discount'=>$request->input('discount'),
                'percent_discount'=>$request->input('pdiscount'),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'currency_id'=>$request->session()->get('currency_id'),
                'updated_by'=>$session['id']

            ]
        );
       return Response()->json
       (
            [
                'id'=>$id
            ]
        );
    }
    public function addData(Request $request){
        //print_r($_POST);
        //exit;
        $session = $request->session()->get('user_id');
        $po = new PurchaseOrder();
        $po->purchase_order_no=$request->input('sales_order_no');
        $po->date=$request->input('date');
        $po->updated_by = $session['id'];
        $po->branch_id = $request->input('branch');
        $po->vendor_id = $request->input('customer_id');
        $po->currency_id =$request->input('currency_id');
        $po->payment_term_id =$request->input('term_of_payment_id');
        $po->delivery_type_id=$request->input('delivery_type_id');
        $po->tax_subtotal=$request->input('tax');
        $po->grand_total_w_tax=$request->input('grandtotal');
        $po->grand_total=$request->input('subtotal_after_tax');
        if($po->save()) {
            $id = $po->id;
            //$id=1;
            for ($i = 0; $i < count($request->input('productid')); $i++) {
                $productId = $request->input('productid')[$i];
                $qty = $request->input('qty')[$i];
                $unit = $request->input('unit')[$i];
                $price = $request->input('price')[$i];
                //$discount = $request->input('discount')[$i];
                $discount = 0;
                $pdiscount = 0;
                $totalprice = $request->input('total')[$i];
                $rate=$request->input('rate')[$i];
                $tax=$totalprice*($rate/100);
                DB::table('purchase_order_detail')->insert(
                    ['purchase_order_id' => $id,'product_id' => $productId,'price'=>$price,'total'=>$totalprice,'qty' => $qty,'discount' => $discount,'percent_discount' => $pdiscount,
                        'unit_id'=>$unit,
                        'currency_id'=>$request->session()->get('currency_id'),
                        'created_at'=> Carbon::now(),
                        'updated_at'=> Carbon::now(),
                        'updated_by'=>$session['id'],
                        'tax_id'=>$request->input('taxid')[$i],
                        'tax_total'=>$tax
                      ]
                );
            }
            return Response()->json(
                ['status' => true, 'msg' => 'Data has added!','type'=>'success','title'=>'Success']
            );
       }else {
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function updateData(Request $request,$id){
        $session = $request->session()->get('user_id');
       echo json_encode($_POST);
        DB::table('purchase_order')
            ->where('id',  $request->input('idpo'))
            ->update(
                [
                    'total' => $request->input('sumtotal'),
                    'currency_id' => $request->session()->get('currency_id'),
                    'updated_by'=>$session['id'],
                    'branch_id'=>$request->input('branch')
                ]);
        DB::table('purchase_order_detail')
            ->where('id',  $id)
            ->update(
                [
                    'qty' => $request->input('qty'),
                    'currency_id' => $request->session()->get('currency_id'),
                    'product_id' => $request->input('product_id'),
                    'price' => $request->input('price'),
                    'total' => $request->input('total'),
                    'discount' => $request->input('discount'),
                    'percent_discount' => $request->input('pdiscount'),
                    'updated_by'=>$session['id']
                ]
            );
    }
    public function updatePrice(Request $request,$id){
        $po = PurchaseOrder::where('id',$id)->first();
        $po->total = $request->input('sumtotal');
        $po->update();
    }
    public function getDetail($id){
        $detail = DB::table('purchase_order_detail as a')
            ->join('product as b','b.id','=','a.product_id')
            ->leftjoin('unit as c','a.unit_id','=','c.id')
            ->leftjoin('vwunitcon as d',function($q){
              $q->on('a.product_id','=','d.product_id');
              $q->on('a.unit_id','=','d.unit_id');
            })
            ->where('purchase_order_id','=',$id)
            ->wherenull('a.deleted_at')
            ->select('a.id','a.price','a.discount','a.total','a.tax_id','a.tax_total','a.qty as unit_qty','b.*','c.name as unitname','c.id as unitid','d.qty as qtykali',
            DB::raw('a.qty * d.qty as qty'))
            ->get();
        return Response()->json(
            [
            'msg'=>$detail
            ]);
    }
    public function deletePO($id){
        $po = PurchaseOrder::find($id);
        if ($po->total==0){
            $po->delete();

        return Response()->json(
            ['status' => true, 'msg' => 'Data PO has deleted!','type'=>'success','title'=>'Purchase Order']
        );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Product Data Exists !', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function deleteProduct($id){
        DB::table('purchase_order_detail')->where('id',$id)->update(['deleted_at' => Carbon::now()]);
        return Response()->json(
            ['status' => true, 'msg' => 'Data has deleted!','type'=>'success','title'=>'Purchase Order detail product']
        );
    }
    public function getAllData(Request $request){
      $data = purchaseOrder::where('purchase_order_no','like','%'.$request->get('code').'%')->get();
      return Response()->json(['msg'=>$data]);
    }
}
