<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class PriceController extends Controller
{
    //
    public function getData(){
        $price = DB::table('selling_price as a')
            ->leftjoin('product as b','b.id','=','a.product_id')
            ->leftjoin('customer_group as c','c.id','=','a.customer_group_id')
            ->leftjoin('branch as d','d.id','=','a.branch_id')
            ->select('a.*','b.name','c.name as customer_group','a.id as ids','d.description','a.price as selling_price')
            ->get();
        return Datatables::of($price)
            ->editColumn('branch_id', function ($price){
                return $price->description;
            })
            ->addColumn('action', function ($price) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#" class="/promotion/'.$price->id.'" data-productid="'.$price->product_id.'"  data-groupid="'.$price->customer_group_id.'" data-id="'.$price->ids.'"  data-price="'.$price->price.'">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#" class="delete" data-id="'.$price->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }
    public function addData(Request $request){
        //print_r($_POST);
        $product = $request->input('product_id');
        $customer_group = $request->input('customer_group');
        $price = $request->input('price');
        $branch = $request->input('branch_id');
        try {
            //$save = DB::statement("call spins_price ('" . $procutid . "','" . $customer_group . "','" . $price . "','" . $branch . "')");
            $save= DB::table('selling_price')->insert([
              'product_id'=>$product,
              'branch_id'=>$branch,
              'price' =>$price,
              'customer_group_id'=>$customer_group,
              'reg_disc_1'=>$request->input('disc1'),
              'reg_disc_2'=>$request->input('disc2'),
              'updated_by'=>$request->session()->get('user_id')['id']
            ]);
        }catch (\Exception $e){
            $save=0;
            echo  $e->getMessage();
        }
        //$save=1;


        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Product Price has added!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }

    public function updateData(Request $request,$id){
        //print_r($_POST);
        $product = $request->input('product_id');
        $customer_group = $request->input('customer_group');
        $price = $request->input('price');
        $branch = $request->input('branch_id');
        try {
          $save= DB::table('selling_price')->where('id',$id)->update([
            'product_id'=>$product,
            'branch_id'=>$branch,
            'price' =>$price,
            'customer_group_id'=>$customer_group,
            'reg_disc_1'=>$request->input('disc'),
            'reg_disc_2'=>$request->input('disc2'),
            'updated_by'=>$request->session()->get('user_id')['id']
          ]);
            //$save = DB::statement("call spupd_price ('" . $procutid . "','" . $customer_group . "','" . $price . "','" . $branch . "','".$id."')");
        }catch (\Exception $e){
            echo $er = $e->getMessage();
            $save=0;
        }
        //$save=1;
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Product Price has added!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
    public function deleteData($id){
        try {
            $save = DB::table('price')->where('id', '=', $id)->delete();
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
}
