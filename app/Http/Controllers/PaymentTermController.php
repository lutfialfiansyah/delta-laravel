<?php

namespace App\Http\Controllers;

use App\PaymentTerm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class PaymentTermController extends Controller
{
    public function getData(Request $request){
        $paymentterm = PaymentTerm::all();
        $datatables = Datatables::of($paymentterm);
        return $datatables
            ->addColumn('action', function ($paymentterm) {
                return
                    '<div class="btn-group">
                                       <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#" data-id="'.$paymentterm->id.'" data-name="'.$paymentterm->name.'" data-toggle="modal" class="btnTriggerEdit">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#" data-id="'.$paymentterm->id.'" class="btnTriggerDelete">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);

    }

    public function addData(Request $request){
        $paymentterm = new PaymentTerm();
        $paymentterm->name = $request->input('name');
        $paymentterm->total_period = $request->input('total_period');
        $paymentterm->percent_discount = $request->input('percent_discount');
        $paymentterm->discount_period = $request->input('discount_period');
        $paymentterm->remarks = $request->input('remarks');
        $paymentterm->created_at = Carbon::now('Asia/Jakarta');
//        echo json_encode($paymentterm); exit();

        $this->save = 0;
        $checks = PaymentTerm::all();
        foreach ($checks as $check){
            if (strtolower($check->name) == strtolower($paymentterm->name)){
                $this->save++;
                return response()->json([
                    'status' => false,
                    'title' => 'Ops',
                    'text' => 'Payment term already exists!',
                    'type' => 'warning',
                    'button' => 'btn-success'
                ]);
            }
        }
        if ($this->save == 0){
//            $paymentterm->save();
//            if ($paymentterm->save()){
                return response()->json([
                    'status' => true,
                    'title' => 'Success',
                    'text' => 'Payment term has added!',
                    'type' => 'success',
                    'button' => 'btn-success'
                ]);
//            }
        }
    }

    public function updateData(Request $request, $id){
        $paymentterm = PaymentTerm::find($id);
        $paymentterm->name = $request->input('name');
        $paymentterm->total_period = $request->input('total_period');
        $paymentterm->percent_discount = $request->input('percent_discount');
        $paymentterm->discount_period = $request->input('discount_period');
        $paymentterm->remarks = $request->input('remarks');
//        echo json_encode($paymentterm); exit();
        $paymentterm->save();
        if ($paymentterm->save()){
            return response()->json([
                'status' => true,
                'title' => 'Success',
                'text' => 'Payment term has updated!',
                'type' => 'success',
                'button' => 'btn-success'
            ]);
        }
    }

    public function deleteData($id){
        $paymentter = PaymentTerm::find($id);
        $paymentter->delete();
        return response()->json([
            'status' => true,
            'title' => 'Success',
            'text' => 'Payment term has deleted!',
            'type' => 'success',
            'button' => 'btn-success'
        ]);
    }
    public function getAllData(Request $request){
        $data = PaymentTerm::where('remarks','like','%'.$request->get('code').'%')->get();
        return response()->json(['msg'=>$data]);
    }
}
