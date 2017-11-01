<?php

namespace App\Http\Controllers\CN;

use App\Models\CN\CnTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CnTransactionController extends Controller
{
    //
    public function getData(){
        $cnTransaction =DB::table('cn_transaction as a')
            ->join('customer as b','a.customer_id','=','b.id')
            ->select('a.*','b.name as customer_name')
            ->get();
        //echo json_encode($cnTransaction);
        //e//xit;
        return Datatables::of($cnTransaction)
            ->addColumn('subtotal', function ($cnTransaction) {
                return 'Rp. '.\number_format($cnTransaction->subtotal);
            })
            ->addColumn('action', function ($cnTransaction) {
                return
                    '<div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right" role="menu">
                                                        <li>
                                                            <a href="#" data-toggle="modal" class="stockedit">
                                                                <i class="icon-tag"></i> Edit </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-id="' . $cnTransaction->id . '" class="delete">
                                                                <i class="icon-docs"></i> Delete </a>
                                                        </li>
                                                    </ul>
                                                </div>';
            })
            ->make(true);
    }
    public function addData(Request $request)
    {
        $cn = $request->input('cn_detail');
        $cnbalance = $request->input('cn_balance');
        $st = $request->input('sales_transaction_id');
        $tbayar = $request->input('total');
        $cnTrnsaction = new CnTransaction();
        $cnTrnsaction->cn_transaction_no = $request->input('code');
        $cnTrnsaction->customer_id = $request->input('vendor_id');
        $cnTrnsaction->subtotal = $request->input('bill_amount');
        $cnTrnsaction->branch_id = $request->session()->get('branch_id');
        $cnTrnsaction->currency_id = $request->session()->get('currency_id');
        $cnTrnsaction->updated_by = $request->session()->get('user_id')['id'];
        if ($cnTrnsaction->save()) {
            $cn_transaction_id = $cnTrnsaction->id;
            if ($cn < $st) {
                $icn = 0;
                $cnNominal = $cnbalance[$cn[$icn]];
                for ($i = 0; $i < count($st); $i++) {
                    $dibayar = $tbayar[$st[$i]];
                    if ($cnNominal > 0) {
                        if ($dibayar <= $cnNominal) {
                            $saveTotal = $dibayar;
                            $cnNominal -= $dibayar;
                        } else {
                            $saveTotal = $cnNominal;
                        }
                    } else {
                        $icn++;
                        $cnNominal = $cnbalance[$cn[$icn]];
                    }
                    $Cnid = $cn[$icn];
                    $Stid = $st[$i];
                    $saveTotal;
                    DB::table('cn_transaction_detail')
                        ->insert(
                            [
                                'cn_transaction_id'=>$cn_transaction_id,
                                'cn_detail_id'=>$Cnid,
                                'sales_transaction_id'=>$Stid,
                                'total'=>$saveTotal,
                                'created_at'=>Carbon::now(),
                                'updated_by'=>$request->session()->get('user_id')['id'],
                                'currency_id'=>$request->session()->get('currency_id')
                            ]
                        );
                }
            } else {
                $icn = 0;
                $cnNominal = $tbayar[$st[$icn]];
                for ($i = 0; $i < count($cn); $i++) {
                    $dibayar = $cnbalance[$cn[$i]];
                    if ($cnNominal > 0) {
                        if ($dibayar <= $cnNominal) {
                            $saveTotal = $dibayar;
                            $cnNominal -= $dibayar;
                        } else {
                            $saveTotal = $cnNominal;
                        }
                    } else {
                        $icn++;
                        $cnNominal = $tbayar[$st[$icn]];
                    }
                    $Cnid = $cn[$i];
                    $Stid = $st[$icn];
                    $saveTotal;
                    DB::table('cn_transaction_detail')
                        ->insert(
                            [
                                'cn_transaction_id'=>$cn_transaction_id,
                                'cn_detail_id'=>$Cnid,
                                'sales_transaction_id'=>$Stid,
                                'total'=>$saveTotal,
                                'created_at'=>Carbon::now(),
                                'updated_by'=>$request->session()->get('user_id')['id'],
                                'currency_id'=>$request->session()->get('currency_id')
                            ]
                        );
                }
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
    public function getCnTransactionById($id){
        $cnDetail=DB::table('cn_detail as a')
            ->leftjoin('cn_balance as b','a.id','=','b.cn_detail_id')
            ->where('customer_id',$id)
            ->where('b.balance','>',0)
            ->select('a.*','b.balance')
            ->get();
        return Response()->json(
            ['msg'=>$cnDetail]
        );
    }


    public function getDataCn(){
        $cnTransaction = DB::table('cn_detail as a')
            ->leftjoin('customer as b','a.customer_id','=','b.id')
            ->leftjoin('cn_balance as c','a.id','=','c.cn_detail_id')
            ->select('a.*','b.name','b.code','c.balance')
            ->get();
        return Datatables::of($cnTransaction)
            ->addColumn('total', function ($cnTransaction) {
                return 'Rp. '.number_format($cnTransaction->total);
            })
            ->addColumn('balance', function ($cnTransaction) {
                return 'Rp. '.number_format($cnTransaction->balance);
            })
            ->addColumn('action', function ($cnTransaction) {
                return
                    '<div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-left" role="menu">
                                                        <li>
                                                            <a href="#" data-toggle="modal" class="stockedit">
                                                                <i class="icon-tag"></i> Edit </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-id="' . $cnTransaction->id . '" class="delete">
                                                                <i class="icon-docs"></i> Delete </a>
                                                        </li>
                                                    </ul>
                                                </div>';
            })
            ->make(true);
    }
    public function addDataCn(Request $request){
        $save = DB::table('cn_detail')->insert([
            'customer_id'=>$request->input('vendor_id'),
            'total'=>$request->input('total'),
            'cn_type_id'=>'1',
            'remarks'=>$request->input('remarks')
        ]);
        if($save){
            return Response()->json(
                ['status' => true, 'msg' => 'Data has added!','type'=>'success','title'=>'Success']
            );
        }else {
            return Response()->json(
                ['status' => true, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
}
