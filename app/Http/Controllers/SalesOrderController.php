<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Helpers\MegaTrend;
use App\Product;
use App\Salesman;
use App\SalesOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class SalesOrderController extends Controller
{
    //
    public function getData()
    {
        $so = SalesOrder::all();
        return Datatables::of($so)
            ->addColumn('total', function ($so) {
                return number_format($so->grand_total_w_tax);
            })
            ->addColumn('customerName',function($so){
              return $so->customer->name;
            })
            ->addColumn('salesman',function($so){
              return $so->customer->name;
            })
            ->addColumn('updated_by',function($so){
              return $so->user->getEmployee->first_name;
            })
            ->addColumn('action', function ($so) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-left" role="menu">
                                        <li>
                                            <a href="salesOrder/detail/'.$so->id.'" data-toggle="modal">
                                                <i class="icon-tag"></i> Detail </a>
                                        </li>
                                        <li>
                                            <a href="#" class="delete" data-id="'.$so->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);

    }
    public function insertSalesOrder(){
        $code = MegaTrend::getLastCode('SO','sales_order','sales_order_no');
        $products = Product::all();
        $salesman = Salesman::all();
        $customer =Customer::all();
        return view('modules.sales_order.insert',compact('code','products','salesman','customer'));
    }
    public function addData(Request $request){
        $session = $request->session()->get('user_id');
        $po = new SalesOrder();
        $po->sales_order_no=$request->input('sales_transaction_no');
        $po->date=$request->input('date');
        $po->grand_total=$request->input('subtotal_after_tax');
        $po->branch_id=$request->input('branch');
        $po->currency_id=$request->input('currency_id');
        $po->salesman_id=$request->input('salesman_id');
        $po->customer_id=$request->input('customer_id');
        $po->payment_term_id=$request->input('term_of_payment_id');
        $po->delivery_type_id=$request->input('delivery_type_id');
        $po->tax_subtotal=$request->input('tax');
        $po->grand_total_w_tax=$request->input('grandtotal');
        $po->updated_by = $session['id'];
        if($po->save()) {
            $id = $po->id;
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
                $qty = $request->input('qty')[$i];
                $qtykali = $request->input('qtykali')[$i];
                $unit = $request->input('unit')[$i];
                $price = $request->input('price')[$i];
                $discount = $request->input('discount')[$i];
                //$discount = 0;
                $totalprice = $request->input('total')[$i];
                $rate=$request->input('rate')[$i];
                $tax=$totalprice*($rate/100);
                //$totalhpp = $totalhpp + ( $qty *$price);
                $idSt = DB::table('sales_order_detail')->InsertGetId(
                    [
                        'sales_order_id' => $id,
                        'product_id' => $productId,
                        'price'=>$price,
                        'price_total'=>$totalprice,
                        'discount_total' => $discount,
                        'qty' => $qty*$qtykali,
                        'unit_id'=>$unit,
                        'unit_qty'=>$qty,
                        'conversion_qty'=>$qtykali,
                        'created_at'=> Carbon::now(),
                        'updated_at'=> Carbon::now(),
                        'updated_by'=>$session['id'],
                        'tax_id'=>$request->input('taxid')[$i],
                        'tax_total'=>$tax,
                        'disc1'=>$list_disc_reg[0],
                        'disc2'=>$list_disc_reg[1],
                        'regular_discount'=>$request->input('totdisc_reg')[$i],
                        'promotion_discount'=>($discount-$request->input('totdisc_reg')[$i]),
                        'updated_by'=>$request->session()->get('user_id')['id'],
                        'currency_id'=>$request->session()->get('currency_id')]
                );
                $a=0;
                foreach ($list_disc as $row) {
                    DB::table('pivot_sales_order_promotion_product')->insert(
                      [
                        'sales_order_detail_id'=>$idSt,
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
    public function detailSalesOrder($id){
        $salesOrder=SalesOrder::find($id);
        $detail = DB::table('sales_order_detail as a')
            ->join('product as b','b.id','=','a.product_id')
            ->join('unit as c','c.id','=','a.unit_id')
            ->where('sales_order_id','=',$id)
            ->select('a.*','b.code','b.name','a.id as idpod','c.name as unitname')
            ->get();
        return view('modules.sales_order.detail',compact('salesOrder','detail'));
    }
    public function editSalesOrder($id){
        $products = Product::all();
        $salesman = Salesman::all();
        $customer =Customer::all();
        $salesOrder=SalesOrder::find($id);
        $detail = DB::table('sales_order_detail as a')
            ->join('product as b','b.id','=','a.product_id')
            ->join('unit as c','c.id','=','a.unit_id')
            ->where('sales_order_id','=',$id)
            ->select('a.*','b.code','b.name','a.id as idpod','c.name as unitname')
            ->get();

        return view('modules.sales_order.edit',compact('products','salesOrder','detail','salesman','customer'));
    }
    public function getDetail($id){
        $detail = DB::table('sales_order_detail as a')
            ->join('product as b','b.id','=','a.product_id')
            ->join('unit  as c','c.id','=','a.unit_id')
            ->join('vwunitcon as d',function($q){
              $q->on('a.unit_id','=','d.unit_id')->on('a.product_id','d.product_id');
            })
            ->join('sales_order  as g','g.id','=','a.sales_order_id')
            ->join('vw_summary_stock2 as f',function($q){
              $q->on('g.branch_id','=','f.branch_id')->on('a.product_id','f.id');
            })
            ->leftjoin('vw_pivot_sales_order as e','a.id','=','e.sales_order_detail_id')
            ->select('a.*','b.name','b.code','item_no','c.name as unitname','d.qty as qtykali','e.*',
                      DB::raw('case when a.qty > summarystock then summarystock else a.qty end as qty'),
                      DB::raw('case when a.qty > summarystock then cast(summarystock/d.qty as decimal(3,0)) else a.qty end as unit_qty')
             )
            ->where('a.sales_order_id','=',$id)
            ->get();
        return Response()->json(
            [
                'msg'=>$detail
            ]);
    }
    public function getAllData(Request $request){
      $data = SalesOrder::where('sales_order_no','like','%'.$request->get('code').'%')->get();
      return Response()->json(['msg'=>$data]);
    }
}
