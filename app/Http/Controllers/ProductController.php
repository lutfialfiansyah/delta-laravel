<?php

namespace App\Http\Controllers;

use App\Helpers\MegaTrend;
use App\Product;
use App\ProductBrand;
use App\ProductCategory;
use App\ProductGroup;
use App\ProductSubCategory;
use App\ProductType;
use App\Unit;
use App\UnitConversion;
use App\ProductSpec;
use App\ProductDetail;
use App\CoaList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Auth;

class ProductController extends Controller
{
    public function getData()
    {
        $products =DB::table('product as a')
            ->join('product_brand as b','a.brand_id','=','b.id')
            ->join('unit as c','a.unit_id','=','c.id')
            ->join('product_type as d','a.type_id','=','d.id')
            ->join('product_category as e','a.category_id','=','e.id')
            ->join('product_sub_category as f','a.sub_cat_id','=','f.id')
            ->join('product_group as g','a.group_id','=','g.id')
            ->leftjoin('vw_summary_stock as h','a.id','=','h.product_id')
            ->leftjoin('vw_cogs_history as i','a.id','=','i.product_id')
            ->select('a.*','b.name as brand','h.*','i.price_balance','c.name as unit','d.name as type','e.name as category','f.name as subcategory','g.name as group')
            ->whereNull('a.deleted_at')
            ->orderBy('a.code','asc')
            ->get();

        //$products = Product::all();
        return Datatables::of($products)
            ->addColumn('price', function ($products) {
                return \number_format($products->price_balance);
            })
            ->addColumn('action', function ($products) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="product/detail_product/'.$products->id.'" data-toggle="modal">
                                                <i class="icon-tag"></i> Detail </a>
                                        </li>
                                        <li>
                                            <a href="#" class="delete" data-id="'.$products->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);

    }
    public function getSelect2Unit(Request $request){
        $search = $request->q;
        $data =DB::table('product as a')
            ->join('unit as c','a.unit_id','=','c.id')
            ->select('a.id','c.name as text')
            ->whereNull('a.deleted_at')
            ->orderBy('c.name','asc')
            ->groupBy('c.name')
            ->where('c.name','like',"%$search%")
            ->get();
        return response()->json($data);
    }
    public function getSelect2Type(Request $request){
        $search = $request->q;
        $data =DB::table('product as a')
            ->join('product_type as d','a.type_id','=','d.id')
            ->select('a.id','d.name as text')
            ->whereNull('a.deleted_at')
            ->orderBy('d.name','asc')
            ->groupBy('d.name')
            ->where('d.name','like',"%$search%")
            ->get();
        return response()->json($data);
    }
    public function getSelect2Category(Request $request){
        $search = $request->q;
        $data =DB::table('product as a')
            ->join('product_category as e','a.category_id','=','e.id')
            ->select('a.id','e.name as text')
            ->whereNull('a.deleted_at')
            ->orderBy('e.name','asc')
            ->groupBy('e.name')
            ->where('e.name','like',"%$search%")
            ->get();
        return response()->json($data);
    }
    public function getSelect2SubCat(Request $request){
        $search = $request->q;
        $data =DB::table('product as a')
            ->join('product_category as e','a.category_id','=','e.id')
            ->join('product_sub_category as f','a.sub_cat_id','=','f.id')
            ->select('a.id','f.name as text')
            ->whereNull('a.deleted_at')
            ->orderBy('f.name','asc')
            ->groupBy('f.name')
            ->where('f.name','like',"%$search%")
            ->get();
        return response()->json($data);
    }
    public function getSelect2Brand(Request $request){
        $search = $request->q;
        $data =DB::table('product as a')
            ->join('product_brand as b','a.brand_id','=','b.id')
            ->select('a.id','b.name as text')
            ->whereNull('a.deleted_at')
            ->orderBy('b.name','asc')
            ->groupBy('b.name')
            ->where('b.name','like',"%$search%")
            ->get();
        return response()->json($data);
    }
    public function getSelect2Group(Request $request){
        $search = $request->q;
        $data =DB::table('product as a')
            ->join('product_group as g','a.group_id','=','g.id')
            ->select('a.id','g.name as text')
            ->whereNull('a.deleted_at')
            ->orderBy('g.name','asc')
            ->groupBy('g.name')
            ->where('g.name','like',"%$search%")
            ->get();
        return response()->json($data);
    }
    public function getDataRecycle()
    {
        $products =DB::table('product as a')
            ->join('product_brand as b','a.brand_id','=','b.id')
            ->join('unit as c','a.unit_id','=','c.id')
            ->join('product_type as d','a.type_id','=','d.id')
            ->join('product_category as e','a.category_id','=','e.id')
            ->join('product_sub_category as f','a.sub_cat_id','=','f.id')
            ->join('product_group as g','a.group_id','=','g.id')
            ->leftjoin('vw_summary_stock as h','a.id','=','h.product_id')
            ->leftjoin('vw_cogs_history as i','a.id','=','i.product_id')
            ->select('a.*','b.name as brand','h.*','i.*','c.name as unit','d.name as type','e.name as category','f.name as subcategory','g.name as group')
            ->whereNotNull('a.deleted_at')
            ->get();
        //$products = Product::all();
        return Datatables::of($products)
            ->addColumn('price', function ($products) {
                return number_format($products->price);
            })
            ->addColumn('action', function ($products) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-left" role="menu">
                                        <li>
                                            <a href="product/detail_product/'.$products->id.'" data-toggle="modal">
                                                <i class="icon-tag"></i> Detail </a>
                                        </li>
                                        <li>
                                            <a href="#" class="restore" data-id="'.$products->id.'">
                                                <i class="icon-docs"></i> Restore </a>
                                        </li>
                                        <li>
                                            <a href="#" class="deletePermanent" data-id="'.$products->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);

    }
    public function insertproduct(){
        $code = MegaTrend::getLastCode("PR",'product','code');
        $brands = ProductBrand::all();
        $categorys=ProductCategory::all();
        $types = ProductType::all();
        $units = Unit::all();
        $groups = ProductGroup::all();
        $branch = DB::table('branch')->get();
        return view('modules.product.insert_product',compact('branch','brands','code','categorys','units','types','groups'));
    }
    public function insertproductv2(){
        $itemno = MegaTrend::getProductItem("P",'product','brand_id');
        $code = MegaTrend::getLastCode("PR",'product','code');
        $brands = ProductBrand::all();
        $categorys=ProductCategory::all();
        $types = ProductType::all();
        $units = Unit::all();
        $groups = ProductGroup::all();
        $branch = DB::table('branch')->get();
        return view('modules.product.insertv2',compact('itemno','branch','brands','code','categorys','units','types','groups'));
    }
    public function getSubCategory($id){
        $subscat = ProductSubCategory::find(['category_id'=>$id]);
        //echo json_encode($subscat);
        return Response()->json(
            [ 'msg' => $subscat]
        );
    }
    public function detailproduct($id){
        $data = DB::table('product as a')
            ->leftjoin('product_type as b','b.id','=','a.type_id')
            ->leftjoin('product_group as c','c.id','=','a.group_id')
            ->leftjoin('product_brand as d','d.id','=','a.brand_id')
            ->leftjoin('product_category as e','e.id','=','a.category_id')
            ->leftjoin('product_sub_category as f','f.id','=','a.sub_cat_id')
            ->leftjoin('unit as g','g.id','=','a.unit_id')
            ->where('a.id','=',$id)
            ->select('a.*','b.name as type','c.name as group','d.name as brand','e.name as category','f.name as sub_category','g.name as unit')
            ->get()->first();
        return view('modules.dashboard.product_dashboard',compact('data'));
    }
    public function restoreData($id){
        $salesman = Product::withTrashed()
            ->where('id', $id);
        if($salesman->restore()) {
            return Response()->json(
                ['status' => true, 'msg' => 'Data has restored!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function editproduct($id){
        $product = Product::find($id);
        $brands = ProductBrand::all();
        $categorys=ProductCategory::all();
        $subcat = ProductSubCategory::all();
        $types = ProductType::all();
        $units = Unit::all();
        $groups = ProductGroup::all();
        $branch = DB::table('branch')->get();
        $spec = ProductSpec::all();
        $unitcon = DB::table('vwunitcon as a')
        ->select('product_id','b.name','c.name','qty','a.unit_id as id')
        ->join('product as b','a.product_id','=','b.id')
        ->join('unit as c','c.id','=','a.unit_id')
        ->where('a.product_id',$product->id)
        ->orderBy('product_id','c.id')
        ->get();
        //echo json_encode($unitcon);
        //exit;
        $productcoa = CoaList::all();
        $procoa = DB::table('product_coa as a')
        ->select('a.product_id as id','b.code','b.name','a.coa_list_id','a.module_index_id')
        ->leftjoin('coa_list as b','a.coa_list_id','=','b.id')
        ->leftjoin('module_index as c','a.module_index_id','=','c.id')
        ->where('product_id',$product->id)
        ->get();
        // dd($procoa);
        $spec = ProductSpec::all();
        $productdetail = ProductDetail::all();
        $prodetail = DB::table('product_detail as a')
        ->select('d.name as tax','c.code','c.name as ven','a.vendor_id','a.tax_id','a.id')
        ->leftjoin('product as b','b.id','=','a.product_id')
        ->leftjoin('vendor as c','c.id','=','a.vendor_id')
        ->leftjoin('tax as d','d.id','=','a.tax_id')
        ->where('product_id',$product->id)
        ->get();
        // echo json_encode($prodetail);
        // exit();

        return view('modules.product.editv2_product',compact('prodetail','spec','procoa','unitcon','branch','brands','categorys','units','types','groups','product'));
    }
    public function getProduct(Request $request){
        $find = $request->input('product');
        $product = DB::table('product')
            ->where('name', 'like', '%'.strtoupper($find).'%')
            ->orWhere('code', 'like', '%'.strtoupper($find).'%')
            ->get();
        return Response()->json($product);
    }
    public function addDatas(Request $request ){
        $code=$request->input('code');
        $name=$request->input('name');
        $unit=$request->input('unit');
        $type=$request->input('type');
        $brand=$request->input('brand');
        $category=$request->input('category');
        $subCategory=$request->input('subcategory');
        $group = $request->input('group');
        $maxPaymentPeriode = $request->input('maxpaymentperiode');
        //exit;
        $stockmin = $request->input('stokmin');
        $price = $request->input('itemno');
        $sql="call spins_product('".$code."','".$name."','".$unit."','".$type."','".$category."','".$subCategory."','".$brand."','".$group."','".$maxPaymentPeriode."','".$stockmin."','".$price."','".$request->input('branch') ."')";

        try {
            $save =DB::statement($sql);
        }catch (\Exception $e){
            $save=0;
        }
       // print_r($brand);
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Success','type'=>'success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Failed','type'=>'warning']
            );
        }
    }
    public function updateDatas(Request $request,$id){
        if($request->isJson()){
             $sql = "call spupd_product('" . $request->json('code') . "','" . $request->json('name') . "','" . $request->json('unit') . "',
       '" . $request->json('type') . "','" . $request->json('category') . "','" . $request->json('subcategory') . "','" . $request->json('brand') . "',
       '" . $request->json('group') . "','" . $request->json('maxpaymentperiode') . "','" . $request->json('stokmin') . "','" . $id . "')";
            //exit;
        }else {
            $sql = "call spupd_product('" . $request->input('code') . "','" . $request->input('name') . "','" . $request->input('unit') . "',
       '" . $request->input('type') . "','" . $request->input('category') . "','" . $request->input('subcategory') . "','" . $request->input('brand') . "',
       '" . $request->input('group') . "','" . $request->input('maxpaymentperiode') . "','" . $request->input('stokmin') . "','" . $request->input('itemno') . "','" . $request->input('branch') . "','" . $id . "')";
        }

        try {
            $save =DB::statement($sql);
        }catch (\Exception $e){
            $save=0;
            //echo $e->getMessage();
        }
        // print_r($brand);
        //$save=1;
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Product has updated','type'=>'success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!!','type'=>'warning']
            );
        }
    }
    public function deleteData($id){
        try {
            $save = Product::where('id',$id)->delete();
        }catch (\Exception $e){
            $save=0;
        }
        if($save) {
            return Response()->json(
                ['status' => true, 'msg' => 'Product has Deleted!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
    public function getPriceProduct($id){
        $product = Product::find($id);
        return Response()->json(
            ['price' => (int)$product->price]
        );
    }
    public function getAllData(Request $request){

        $data = DB::table('product as a')
            ->leftjoin('selling_price as b','a.id','=','b.product_id')
            ->leftjoin('unit as c','a.unit_id','=','c.id')
            ->leftjoin('vwunitcon as d',function($q){
              $q->on('a.unit_id','=','d.unit_id')->on('a.id','d.product_id');
            })
            ->where('code','like', '%' .$request->get('code').'%')
            ->where('b.branch_id',$request->get('branch_id'))
            ->where('b.customer_group_id',$request->get('customer_group_id'))
            ->whereNull('a.deleted_at')
            ->select('a.*','b.price as selling_price','reg_disc_1','reg_disc_2','c.name as unit_name','d.qty as qtykali')
            ->get();
        return Response()->json([
            'data'=>$data
        ]);
    }
    public function getAllsData(Request $request){

        $data = DB::table('product as a')->select('a.*')
            ->get();
        return Response()->json([
            'data'=>$data
        ]);
    }
    public function getAllDataPO(Request $request){

        $data = DB::table('product as a')->select('a.*','c.name as unitname','d.qty as qtykali')
            ->leftjoin('unit as c','a.unit_id','=','c.id')
            ->leftjoin('vwunitcon as d',function($q){
              $q->on('a.unit_id','=','d.unit_id')->on('a.id','d.product_id');
            })
            ->get();
        return Response()->json([
            'data'=>$data
        ]);
    }
    public function cekStock(Request $reg,$id){
       if($reg->get('qtys')!=null){
         try{
           $stock = DB::table('vw_summary_stock2')
               ->where('id',$id)
               ->where('branch_id','=',$reg->get('branch_id'))
               ->where('summarystock','>=',$reg->get('qtys'))
               ->get()
               ->first();
               return Response()->json(
                 ['status'=>1,'msg' =>$stock->summarystock]
               );
         }catch(\Exception $e){
           $stock = DB::table('vw_summary_stock2')
               ->where('id',$id)
               ->where('branch_id','=',$reg->get('branch_id'))
               ->first();
           return Response()->json(
               ['status'=>0,'msg' =>'stock not available','stock'=>(int)$stock->summarystock]
           );
         }
       }else{
         $stock = DB::table('vw_summary_stock2')
             ->where('id',$id)
             ->where('branch_id','=',$reg->get('branch_id'))
             ->get()->first();
         return Response()->json(
             ['summary_stock' => (int)$stock->summarystock]
         );
       }
    }
    public function getDataById($id){
        $data = DB::select('
            select a.name,b.branch_id,e.code as warehouse,(qty+sumproduct-minproduct) as total,c.description,f.unit_2_id,f.unit_2_qty,f.unit_3_id,f.unit_3_qty,f.unit_4_id,f.unit_4_qty,f.unit_5_id,f.unit_5_qty,g.name from product a
            left join stock_beginning b on a.id = b.product_id
            left join branch c on b.branch_id = c.id
            left join vwsumstock d on d.product_id = a.id and d.branch_id = c.id
            left join warehouse e on d.branch_id = e.branch_id
            left join unit_conversion as f on f.product_id = a.id
            left join unit as g on g.id = a.unit_id
            where a.id='.$id.'
            group by c.id
        ');
//        echo json_encode($data);
//        exit();
        return Response()->json(
            ['msg'=>$data]
        );
    }

public function addData(Request $request)
    {
        $item_no = $request['item_no'];
        $code = $request['code'];
        $name = $request['name'];
        $type_id = $request['type_id'];
        $brand_id = $request['brand_id'];
        $category_id = $request['category_id'];
        $sub_cat_id = $request['sub_cat_id'];
        $group_id = $request['group_id'];
        $unit_id = $request['unit_id'];
        $maxpaymentperiode = $request['max_payment_periode'];
        $users = Auth::user()->id;
        $id_product=DB::table('product')
        ->InsertGetId([
            'item_no'=>$item_no,
            'code'=>$code,
            'name'=>$name,
            'unit_id'=>$unit_id,
            'type_id'=>$type_id,
            'brand_id'=>$brand_id,
            'category_id'=>$category_id,
            'sub_cat_id'=>$sub_cat_id,
            'group_id'=>$group_id,
            'updated_by'=>$users
        ]);
        $unit_2_id = $request['unit_2_id'];
        $unit_2_qty = $request['unit_2_qty'];
        $unit_3_id = $request['unit_3_id'];
        $unit_3_qty = $request['unit_3_qty'];
        $unit_4_id = $request['unit_4_id'];
        $unit_4_qty = $request['unit_4_qty'];
        $unit_5_id = $request['unit_5_id'];
        $unit_5_qty = $request['unit_5_qty'];
        $users = Auth::user()->id;
        $save = DB::table('unit_conversion')
        ->Insert([
            'product_id'=>$id_product,
            'unit_2_id'=>$unit_2_id,
            'unit_2_qty'=>$unit_2_qty,
            'unit_3_id'=>$unit_3_id,
            'unit_3_qty'=>$unit_3_qty,
            'unit_4_id'=>$unit_4_id,
            'unit_4_qty'=>$unit_4_qty,
            'unit_5_id'=>$unit_5_id,
            'unit_5_qty'=>$unit_5_qty,
            'updated_by'=>$users
        ]);
        $stock = $request['stock'];
        $module_index_id = '1';
        $users = Auth::user()->id;
        $saves = DB::table('product_coa')
        ->Insert([
            'product_id'=>$id_product,
            'module_index_id'=>$module_index_id,
            'coa_list_id'=>$stock,
            'updated_by'=>$users

        ]);
        $sales_transaction = $request['sales_transaction_id'];
        $module_index_id = '2';
        $users = Auth::user()->id;
        $saves = DB::table('product_coa')
        ->Insert([
            'product_id'=>$id_product,
            'module_index_id'=>$module_index_id,
            'coa_list_id'=>$sales_transaction,
            'updated_by'=>$users
            ]);
        $sales_return = $request['sales_return_id'];
        $module_index_id = '3';
        $users = Auth::user()->id;
        $saves = DB::table('product_coa')
        ->Insert([
            'product_id'=>$id_product,
            'module_index_id'=>$module_index_id,
            'coa_list_id'=>$sales_return,
            'updated_by'=>$users
        ]);
        $purchase_return = $request['purchase_return_id'];
        $module_index_id = '4';
        $users = Auth::user()->id;
        $saves = DB::table('product_coa')
        ->Insert([
            'product_id'=>$id_product,
            'module_index_id'=>$module_index_id,
            'coa_list_id'=>$purchase_return,
            'updated_by'=>$users
        ]);
        $weight = $request['weight'];
        $width = $request['width'];
        $length = $request['length'];
        $height = $request['height'];
        $users = Auth::user()->id;
        $saves = DB::table('product_spec')
            ->Insert([
            'product_id'=>$id_product,
            'weight'=>$weight,
            'width'=>$width,
            'length'=>$length,
            'height'=>$height,
            'updated_by'=>$users
        ]);

        $vendor = $request['vendor_id'];
        $tax = $request['tax_id'];
        $users = Auth::user()->id;
        $saves = DB::table('product_detail')
            ->Insert([
            'product_id'=>$id_product,
            'vendor_id'=>$vendor,
            'tax_id'=>$tax,
            'updated_by'=>$users
        ]);

            return Response()->json(
                ['status' => true, 'msg' => 'Product has updated','type'=>'success']
            );

    }
    public function updateData(Request $request,$id)
    {
        $item_no = $request['item_no'];
        $code = $request['code'];
        $name = $request['name'];
        $type_id = $request['type_id'];
        $brand_id = $request['brand_id'];
        $category_id = $request['category_id'];
        $sub_cat_id = $request['sub_cat_id'];
        $group_id = $request['group_id'];
        $unit_id = $request['unit_id'];
        $users = Auth::user()->id;
        $update = DB::table('product')
        // ->join('addresses', 'users.id', '=', 'addresses.user_id')
        ->where('id',$id)
        ->update([
            'item_no' => $item_no,
            'code' => $code,
            'name' => $name,
            'unit_id' => $unit_id,
            'type_id' => $type_id,
            'brand_id' => $brand_id,
            'category_id' => $category_id,
            'sub_cat_id' => $sub_cat_id,
            'group_id' => $group_id,
            'updated_by' => $users
        ]);

        $unit_2_id = $request['unit_2_id'];
        $unit_2_qty = $request['unit_2_qty'];
        $unit_3_id = $request['unit_3_id'];
        $unit_3_qty = $request['unit_3_qty'];
        $unit_4_id = $request['unit_4_id'];
        $unit_4_qty = $request['unit_4_qty'];
        $unit_5_id = $request['unit_5_id'];
        $unit_5_qty = $request['unit_5_qty'];
        $users = Auth::user()->id;
        $update = DB::table('unit_conversion')
        ->where('product_id','=',$id)
        ->update([
            'unit_2_id'=>$unit_2_id,
            'unit_2_qty'=>$unit_2_qty,
            'unit_3_id'=>$unit_3_id,
            'unit_3_qty'=>$unit_3_qty,
            'unit_4_id'=>$unit_4_id,
            'unit_4_qty'=>$unit_4_qty,
            'unit_5_id'=>$unit_5_id,
            'unit_5_qty'=>$unit_5_qty,
            'updated_by'=>$users
        ]);
        $stock = $request['stock'];
        $module_index_id = '1';
        $users = Auth::user()->id;
        $update = DB::table('product_coa')
        ->where('product_id','=',$id)
        ->Where('module_index_id','=',1)
        ->update([
            //'module_index_id'=>$module_index_id,
            'coa_list_id'=>$stock,
            'updated_by'=>$users

        ]);
        $sales_transaction = $request['sales_transaction_id'];
        $module_index_id = '2';
        $users = Auth::user()->id;
        $update = DB::table('product_coa')
        ->where('product_id','=',$id)
        ->Where('module_index_id','=',2)
        ->update([
          //  'module_index_id'=>$module_index_id,
            'coa_list_id'=>$sales_transaction,
            'updated_by'=>$users
            ]);
        $sales_return = $request['sales_return_id'];
        $module_index_id = '3';
        $users = Auth::user()->id;
        $update = DB::table('product_coa')
        ->where('product_id','=',$id)
        ->Where('module_index_id','=',3)
        ->update([
            //'module_index_id'=>$module_index_id,
            'coa_list_id'=>$sales_return,
            'updated_by'=>$users
        ]);
        $purchase_return = $request['purchase_return_id'];
        $module_index_id = '4';
        $users = Auth::user()->id;
        $update = DB::table('product_coa')
        ->where('product_id','=',$id)
        ->Where('module_index_id','=',4)
        ->update([
            //'module_index_id'=>$module_index_id,
            'coa_list_id'=>$purchase_return,
            'updated_by'=>$users
        ]);
        $weight = $request['weight'];
        $width = $request['width'];
        $length = $request['length'];
        $height = $request['height'];
        $users = Auth::user()->id;
        $update = DB::table('product_spec')
            ->where('product_id','=',$id)
            ->update([
            'weight'=>$weight,
            'width'=>$width,
            'length'=>$length,
            'height'=>$height,
            'updated_by'=>$users
        ]);

        $vendor = $request['vendor_id'];
        $tax = $request['tax_id'];
        $users = Auth::user()->id;
        $update = DB::table('product_detail')
            ->where('product_id','=',$id)
            ->update([
            'vendor_id'=>$vendor,
            'tax_id'=>$tax,
            'updated_by'=>$users
        ]);
            return Response()->json(
                ['status' => true, 'msg' => 'Product has updated','type'=>'success']
            );



    }
    public function getUnitCon(Request $request){
        $data = DB::table('vwunitcon')->where('product_id',$request->get('prod_id'))->where('unit_id',$request->get('unit_id'))->select('qty')->get();
        return Response()->json(['msg'=>$data]);
    }
    public function getUnit(Request $request){
        $data = DB::table('vwunitcon as a')
        ->leftjoin('unit as b','a.unit_id','=','b.id')
        ->where('product_id',$request->get('prod_id'))
        ->whereNotNull('name')->select('b.name','qty','a.unit_id')->get();
        return Response()->json(['msg'=>$data]);
    }
    public function getUnitPerProd(Request $reg,$id){
        $data = DB::select("select a.product_id,branch_id,b.name as product_name,d.name as unit_name,summarystock,cast(summarystock/c.qty as decimal(11,2)) as unit,c.qty from
vw_prod_unit_con a
left join vw_summary_stock2 b
on a.product_id = b.id
left join vwunitcon c on a.unit_id = c.unit_id and a.product_id=c.product_id
left join unit d on a.unit_id = d.id
where a.unit_id is not null
and a.product_id ='".$id."'
and branch_id='".$reg->get('branch_id')."'
order by a.product_id,a.unit_id");
      return Response()->json(['msg'=>$data]);
    }
}
