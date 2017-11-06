<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Delivery;
use App\Helpers\MegaTrend;
use App\PaymentTerm;
use App\Product;
use App\Salesman;
use App\SalesOrder;
use App\SalesTransaction;
use App\Vendor;
use App\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class SalesTransactionController extends Controller
{
    //
    public function getData(){
        $salestransaction = DB::table('sales_transaction as a')
                          ->leftjoin('customer as b','a.customer_id','=','b.id')
                          ->leftjoin('sales_order as c','a.sales_order_id','=','c.id')
                          ->leftjoin('users as d','a.updated_by','=','d.id')
                          ->leftjoin('employee as e','d.employee_id','=','e.id')
                          ->select('a.*','b.name as customerName','c.sales_order_no','e.first_name as updated_by')
                          ->get();
        return Datatables::of($salestransaction)
            ->addColumn('sub_total', function ($salestransaction) {
                return number_format($salestransaction->sub_total);
            })
            ->addColumn('tax_subtotal', function ($salestransaction) {
                return number_format($salestransaction->tax_subtotal);
            })
            ->addColumn('grand_total', function ($salestransaction) {
                return number_format($salestransaction->grand_total);
            })
            ->addColumn('grand_total_w_tax', function ($salestransaction) {
                return number_format($salestransaction->grand_total_w_tax);
            })
            ->addColumn('action', function ($salestransaction) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="salesTransaction/detail/'.$salestransaction->id.'" >
                                                <i class="icon-tag"></i> Detail </a>
                                        </li>
                                        <li>
                                            <a href="#" class="delete" data-id="'.$salestransaction->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }
    public function insertSalesTransaction(){
        $code = MegaTrend::getLastCode("ST",'sales_transaction','sales_transaction_no');
        $tax = DB::table('tax')->get();
        return view('modules.sales_transaction.insert',compact('code','products','warehouse','paymentTerm',
            'salesOrder','shippingMethod','supplier','customer','salesman','tax'));

    }
    public function editSalesTransaction($id){
        $salesTransaction = SalesTransaction::find($id);
        $detail = DB::table('sales_transaction_detail as a')
            ->join('product as b','b.id','=','a.product_id')
            ->join('unit as c','c.id','=','a.unit_id')
            ->where('sales_transaction_id','=',$id)
            ->select('a.*','b.item_no','b.code','b.name','a.id as idpd','c.name as unitname')
            ->get();
        $sales_order =DB::table('sales_order')->where('id',$salesTransaction->sales_order_id)->get()[0];
        return view('modules.sales_transaction.edit',compact('salesTransaction','detail','products','warehouse','paymentTerm',
            'salesOrder','shippingMethod','supplier','customer','sales_order'));

    }
    public function detailSalesTransaction($id){
        $st = SalesTransaction::find($id);
        $detail = DB::table('sales_transaction_detail as a')
            ->join('product as b','b.id','=','a.product_id')
            ->join('unit as c','c.id','=','a.unit_id')
            ->where('sales_transaction_id','=',$id)
            ->select('a.*','b.item_no','b.code','b.name','a.id as idpd','c.name as unitname')
            ->get();
        $sales_order_no =DB::table('sales_order')->where('id',$st->sales_order_id)->get()[0]->sales_order_no;
        return view('modules.sales_transaction.detail',compact('st','detail','sales_order_no'));
    }
    public function addData(Request $request){
        $purchase = new SalesTransaction();
        $purchase->sales_transaction_no = $request->input('sales_transaction_no');
        $purchase->date = $request->input('date');
        $purchase->werehouse_id=$request->input('werehouse_id');
        $purchase->sales_order_id=$request->input('sales_order_id');
        $purchase->customer_id=$request->input('customer_id');
        $purchase->salesman_id=$request->input('salesman_id');
        $purchase->delivery_type_id=$request->input('delivery_type_id');
        $purchase->payment_term_id=$request->input('term_of_payment_id');
        $purchase->sub_total=$request->input('subtotal_before_tax');
        $purchase->other_discount=$request->input('otherdiscount');
        $purchase->other_cost=$request->input('othercost');
        $purchase->grand_total=$request->input('subtotal_before_tax');
        $purchase->tax_subtotal=$request->input('tax');
        $purchase->grand_total_w_tax=$request->input('grandtotal');
        $purchase->branch_id=$request->input('branch');
        $purchase->currency_id=$request->input('currency_id');
        $purchase->updated_by=$request->session()->get('user_id')['id'];
        if($purchase->save()) {
            $id = $purchase->id;
            //$id=1;
            $totalhpp = 0;
            for ($i = 0; $i < count($request->input('productid')); $i++) {
              $list_disc = explode(',',$request->input('list_disc')[$i]);
              $list_disc_reg = explode(',',$request->input('list_disc_reg')[$i]);
              $list_disc_pro2 = explode(',',$request->input('list_disc_pro2')[$i]);
              $list_disc_pro = explode(',',$request->input('list_disc_pro')[$i]);
              unset($list_disc[count($list_disc)-1]);
              unset($list_disc_reg[count($list_disc_reg)-1]);
              unset($list_disc_pro2[count($list_disc_pro2)-1]);
              unset($list_disc_pro[count($list_disc_pro)-1]);
                $productId = $request->input('productid')[$i];
                $unit_qty = $request->input('qty')[$i];
                $qtykali = $request->input('qtykali')[$i];
                $price = $request->input('price')[$i];
                $discount = $request->input('discount')[$i];
                $unit = $request->input('unit')[$i];
                $totalprice = $request->input('total')[$i];
                $totalhpp = $totalhpp + ( ($qtykali*$unit_qty) *$price);
                $idSt = DB::table('sales_transaction_detail')->insertGetId(
                    ['sales_transaction_id' => $id,
                        'unit_id'=>$unit,'product_id' => $productId,
                        'price'=>$price,
                        'price_total'=>$totalprice,
                        'qty' => $qtykali*$unit_qty,
                        'unit_qty' => $unit_qty,
                        'discount_total' => $discount,
                        'created_at'=> Carbon::now(),
                        'updated_at'=> Carbon::now(),
                        'conversion_qty'=>$qtykali,
                        'tax_id'=>$request->input('taxid')[$i],
                        'disc1'=>$list_disc_reg[0],
                        'disc2'=>$list_disc_reg[1],
                        'regular_discount'=>$request->input('totdisc_reg')[$i],
                        'promotion_discount'=>($discount-$request->input('totdisc_reg')[$i]),
                        'tax_total'=>$totalprice*($request->input('rate')[$i]/100),
                        'currency_id'=>$request->input('currency_id'),
                        'updated_by'=>$request->session()->get('user_id')['id']
                      ]
                );
                      $a=0;
                      foreach ($list_disc as $row) {
                          DB::table('pivot_sales_promotion_product')->insert(
                            [
                              'sales_transaction_detail_id'=>$idSt,
                              'disc1'=>$list_disc_pro[$a],
                              'disc2'=>$list_disc_pro2[$a],
                              'discount_total'=>$row,
                              'created_at'=> Carbon::now(),
                              'updated_at'=> Carbon::now(),
                              'updated_by'=>$request->session()->get('user_id')['id']
                            ]
                          );
                          $a++;
                      }
                //echo $idSt;
                //exit;
            }

            DB::table('sales_transaction')->where('id',$id)->update(['remarks'=>$request->input('remarks')]);
            return Response()->json(
                ['status' => true, 'msg' => 'Data has added!','type'=>'success','title'=>'Success']
            );
        }else {
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function addProduct(Request $request){
        $id = DB::table('sales_transaction_detail')->insertGetId(
            [
                'product_id'=>$request->input('product_id'),
                'sales_transaction_id'=>$request->input('idpo'),
                'total'=>$request->input('total'),
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
    public function updateData(Request $request,$id)
    {
        DB::table('sales_transaction_detail')
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
        $st = SalesTransaction::where('id',$request->input('idpo'))->first();
        $st->warehouse_id = $request->input('warehouse_id');
        $st->sub_total = $request->input('totalsum');
        $st->payment_term_id = $request->input('payment_term_id');
        $st->sales_order_id = $request->input('sales_order_id');
        $st->updated_at = Carbon::now();
        $st->update();

    }
    public function updatePrice(Request $request,$id){
        $p = SalesTransaction::where('id',$id)->first();
        $p->delivery_type_id =  $request->input('delivery_id');
        $p->grand_total =  $request->input('grandtotal');
        $p->other_discount =  $request->input('otherdiscount');
        $p->other_cost =  $request->input('othercost');
        $p->sales_order_id = $request->input('sales_order_id');
        //echo json_encode($p);
        $p->update();
    }
    public function getSalesTransNoByCustomer($id){
        $salesTransction = DB::table('sales_transaction as a')
            ->join('ar_payment_balance as b','a.id','=','b.id')
            ->where('customer_id',$id)
            ->where('b.balance',"<>",'0')
            ->get();
        return Response()->json(
            ['msg'=>$salesTransction]
        );
    }
    public function getAllData(Request $request){
        $data = SalesTransaction::where('id','like','%'.$request->get('sales_transaction_no').'%')->get();
        return Response()->json(['data'=>$data]);
    }
}
