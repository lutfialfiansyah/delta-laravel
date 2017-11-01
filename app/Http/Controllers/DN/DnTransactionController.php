<?php

namespace App\Http\Controllers\DN;

use App\Models\DN\DnTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class DnTransactionController extends Controller
{
    //
    public function getData(){
        $cnTransaction =DB::table('dn_transaction as a')
            ->join('vendor as b','a.vendor_id','=','b.id')
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
    public function getDnTransactionById($id){
        $cnDetail=DB::table('dn_detail as a')
            ->leftjoin('dn_balance as b','a.id','=','b.dn_detail_id')
            ->where('vendor_id',$id)
            ->where('b.balance','>',0)
            ->select('a.*','b.balance')
            ->get();
        return Response()->json(
            ['msg'=>$cnDetail]
        );
    }

    public function addData(Request $request)
    {
        $cn = $request->input('cn_detail');
        $cnbalance = $request->input('cn_balance');
        $st = $request->input('sales_transaction_id');
        $tbayar = $request->input('total');
        $cnTrnsaction = new DnTransaction();
        $cnTrnsaction->dn_transaction_no = $request->input('code');
        $cnTrnsaction->vendor_id = $request->input('vendor_id');
        $cnTrnsaction->subtotal = $request->input('bill_amount');
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
                    DB::table('dn_transaction_detail')
                        ->insert(
                            [
                                'dn_transaction_id'=>$cn_transaction_id,
                                'dn_detail_id'=>$Cnid,
                                'purchase_transaction_id'=>$Stid,
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
}
