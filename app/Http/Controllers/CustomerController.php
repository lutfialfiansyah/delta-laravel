<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerGroup;
use App\Helpers\MegaTrend;
use App\PaymentTerm;
use App\Salesman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CustomerController extends Controller
{
    //
    public function getData(){
        $Customers = DB::table('customer as a')
            ->leftjoin('customer_group as b','b.id','=','a.customer_group_id')
            ->leftjoin('payment_term as c','c.id','=','a.payment_term_id')
            ->select('a.*','b.name as cgname','c.name as paymentname')
            ->wherenull('a.deleted_at')
            ->get();
        return Datatables::of($Customers)
            ->addColumn('action', function ($Customers) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="customer/detail_customer/'.$Customers->id.'" >
                                                <i class="icon-tag"></i> Detail </a>
                                        </li>
                                        <li>
                                            <a href="#" class="delete" data-id="'.$Customers->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }
    public function insertcustomer(){
        $customerGroups = CustomerGroup::all();
        $paymentterms = PaymentTerm::all();
        $salesman = DB::table('salesman as a')->leftjoin('employee as b','a.employee_id','=','b.id')->select('a.id','a.code','first_name as name')->get();
        $code = MegaTrend::getLastCode('C','customer','code');
        $branch = DB::table('branch')->get();
        return view('modules.customer.insert_customer',compact('branch','salesman','customerGroups','paymentterms','code'));
    }
    public function editcustomer($id){
        $customerGroups = CustomerGroup::all();
        $paymentterms = PaymentTerm::all();
        $salesman = DB::table('salesman as a')->leftjoin('employee as b','a.employee_id','=','b.id')->select('a.id','a.code','first_name as name')->get();
        $data = Customer::find($id);
        $branch = DB::table('branch')->get();
        return view('modules.customer.edit_customer',compact('branch','salesman','customerGroups','paymentterms','data'));
    }
    public function detailcustomer($id){
        $data = DB::table('customer as a')
            ->leftjoin('customer_group as b','b.id','=','a.customer_group_id')
            ->leftjoin('payment_term as c','c.id','=','a.payment_term_id')
            ->where('a.id','=',$id)
            ->select('a.*','b.name as customer_group','c.name as payment_term','c.total_period','c.discount_period','c.percent_discount')
            ->get()->first();
        //echo  json_encode($data);
        return view('modules.customer.detail_customer',compact('data'));
    }
    public function addData(Request $request){
        $sql = "call spins_customer('".$request->input('code')."' ,'".$request->input('name')."','".$request->input('customer_group')."','".$request->input('area')."','".$request->input('salesman')."','".$request->input('payment_term')."')";
        try {
            $save =DB::statement($sql);
        }catch (\Exception $e){
            $save=0;
        }
        //$save=0;
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Customer has added!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'error','title'=>'Ops!!']
            );
        }

    }
    public function updateData(Request $request,$id){
       $sql = "call spupd_customer('".$request->input('code')."' ,'".$request->input('name')."','".$request->input('customer_group')."','".$request->input('area')."','".$request->input('salesman')."','".$request->input('payment_term')."','".$id."')";
        try {
            $save =DB::statement($sql);
        }catch (\Exception $e){
            $save=0;
        }
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Customer has updated!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'error','title'=>'Ops!!']
            );
        }
    }
    public function deleteData($id){
        try {
            $save = DB::table('customer')->where('id', '=', $id)->update(['deleted_at'=>Carbon::now()]);
        }catch (\Exception $e){
            $save=0;
        }
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Data has Deleted!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
    public function getAllData(Request $request){
        $data = Customer::where('code', 'LIKE', '%'.$request->get('code').'%')->get();
        return Response()->json([
            'msg'=>$data
        ]);
    }
}
