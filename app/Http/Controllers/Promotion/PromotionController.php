<?php

namespace App\Http\Controllers\Promotion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Models\Promotion\Promotion;
use Carbon\Carbon;
use App\Product;
use App\ProductBrand;
use App\ProductType;
use App\ProductGroup;
use App\ProductCategory;
use App\ProductSubCategory;
use App\Helpers\MegaTrend;
use App\CustomerGroup;
class PromotionController extends Controller
{
    //
    public function getData()
    {
      $promotion = Promotion::all();
      return Datatables::of($promotion)
          ->addColumn('updated_by',function($promotion){
              return $promotion->users->getEmployee->first_name;
          })
          ->addColumn('action', function ($promotion) {
              return
                  '<div class="btn-group">
                                  <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                      <i class="fa fa-angle-down"></i>
                                  </button>
                                  <ul class="dropdown-menu pull-right" role="menu">
                                      <li>
                                          <a href="'.url('promotion/'.$promotion->id).'" data-toggle="modal">
                                              <i class="icon-tag"></i> Detail </a>
                                      </li>
                                      <li>
                                          <a href="#" class="delete" data-id="'.$promotion->id.'">
                                              <i class="icon-docs"></i> Delete </a>
                                      </li>
                                  </ul>
                              </div>';
          })
          ->make(true);
    }
    public function insert(){
        $code = MegaTrend::getLastCode('D','promotion_product','code');
        return view('modules.promotion.insert',compact('code'));
    }
    public function updateData($id){
        $promotion = Promotion::where('id',$id)->first();
        $product = Product::whereRaw("find_in_set(id,'".$promotion->product."')")->select('id','name')->get();
        $brand = Productbrand::whereRaw("find_in_set(id,'".$promotion->brand."')")->select('id','name')->get();
        $customer_group = CustomerGroup::whereRaw("find_in_set(id,'".$promotion->customer_group."')")->select('id','name')->get();
        $category = ProductCategory::whereRaw("find_in_set(id,'".$promotion->category."')")->select('id','name')->get();
        $subcategory = ProductSubCategory::whereRaw("find_in_set(id,'".$promotion->sub_category."')")->select('id','name')->get();
        $type = ProductType::whereRaw("find_in_set(id,'".$promotion->product_type."')")->select('id','name')->get();
        $group = ProductSubCategory::whereRaw("find_in_set(id,'".$promotion->product_group."')")->select('id','name')->get();
        return view('modules.promotion.update',compact('promotion','product','brand','customer_group','category','subcategory','type','group'));
    }
    public function cekPromotion(Request $req){
         $dt = Carbon::now();
         $promotion =DB::table('promotion_product')->where('time_start', '<=',$dt)
         ->where('time_end', '>=',$dt)->orderBy('time_start','asc')
         ->select('description','disc1','disc2','product','customer_group','brand','category','sub_category','product_type','product_group',
          DB::raw('(qty*1) as qty')
         ,'unit_id')
         ->get();
         $prodid = $req->get('prodid');
         $custid = $req->get('custid');
         $cgroup = customerGroup::where('id',$custid)->first();
         $unit_id = $req->get('unitid');
         $qty = $req->get('qty');
         $getProd = Product::where('id',$prodid)->first();
         $cat = $getProd['category_id'];
         $brand = $getProd['brand_id'];
         $scat = $getProd['sub_cat_id'];
         $type = $getProd['type_id'];
         $group = $getProd['group_id'];
         $cekid= array();
         array_push($cekid,$prodid);
         array_push($cekid,$cat);
         array_push($cekid,$cgroup['customer_group_id']);
         array_push($cekid,$brand);
         array_push($cekid,$scat);
         array_push($cekid,$type);
         array_push($cekid,$group);
         array_push($cekid,$qty);
         //array_push($cekid,$unit_id);
         $data =array();
         $allpromo=array();
         foreach($promotion as $row){
            unset($cekpromo);
            $cekpromo = array();
            $arrprod = explode(',',$row->product);
            array_push($cekpromo,$arrprod);
            $arrcat = explode(',',$row->category);
            array_push($cekpromo,$arrcat);
            $arrcg = explode(',',$row->customer_group);
            array_push($cekpromo,$arrcg);
            $arrbrand = explode(',',$row->brand);
            array_push($cekpromo,$arrbrand);
            $arrscat = explode(',',$row->sub_category);
            array_push($cekpromo,$arrscat);
            $arrprodType = explode(',',$row->product_type);
            array_push($cekpromo,$arrprodType);
            $arrprodGroup = explode(',',$row->product_group);
            array_push($cekpromo,$arrprodGroup);
            $cekpcs = DB::table('vwunitcon')
                      ->where('product_id',$prodid)
                      ->where('unit_id',$row->unit_id)
                      ->whereNotNull('unit_id')->get()->first();
                      //$cekpcs->qty*$row->qty;
            array_push($cekpromo,$cekpcs->qty*$row->qty);
            //array_push($cekpromo,explode(',',1));
            $c = true;
            $i=0;
            //echo json_encode($cekpromo);
            foreach($cekpromo as $row2){
                //print_r($row2);
                if($c==true){
                  if($row2[0]==0){
                      //echo $row2[0];
                      $c=true;
                      unset($data);
                      $data['desc']=$row->description;
                      $data['disc']=$row->disc1;
                      $data['disc2']=$row->disc2;
                      $c=true;
                  }else if(is_array($row2)){
                    if($cekid[7]>=$cekpromo[7]){
                      if(in_array($cekid[$i],$row2)){
                        unset($data);
                        //echo "a".json_encode($row2);
                        $data['desc']=$row->description;
                        $data['disc']=$row->disc1;
                        $data['disc2']=$row->disc2;
                        $c=true;
                      }else{
                          $c=false;
                          unset($data['desc']);
                          unset($data['disc']);
                          unset($data['disc2']);
                          break;
                      }
                    }else{
                      $c=false;
                      unset($data['desc']);
                      unset($data['disc']);
                      unset($data['disc2']);
                      break;
                    }
                  }else{
                    if($cekid[$i]>=$row2){
                      echo "a".$cekid[$i]."-".$row2;
                      $data['desc']=$row->description;
                      $data['disc']=$row->disc1;
                      $data['disc2']=$row->disc2;
                      $c=true;
                    }else{
                      unset($data['desc']);
                      unset($data['disc']);
                        unset($data['disc2']);
                      $c=false;
                      //break;
                      break;
                    }
                  }
                }
                $i++;
            }
            if(!empty($data)){
              array_push($allpromo,$data);
            }
         }
         return Response()->json(['msg'=>$allpromo]);
    }
    public function update(Request $request,$id){
      //print_r($_POST);
      $product_id = 0;
      $brand_id = 0;
      $category_id = 0;
      $sub_cat = 0;
      $customer_group = 0;
      $type = 0;
      $group = 0;
      if($request->input('product_id')!=null){
        $product_id = implode(',',$request->input('product_id'));
      }
      if($request->input('customer_group_id')!=null){
        $customer_group = implode(',',$request->input('customer_group_id'));
      }
      if($request->input('category_id')!=null){
        $category_id = implode(',',$request->input('category_id'));
      }
      if($request->input('category_id')!=null){
        $category_id = implode(',',$request->input('category_id'));
      }
      if($request->input('brand_id')!=null){
        $brand_id = implode(',',$request->input('brand_id'));
      }
      if($request->input('subcategory_id')!=null){
        $sub_cat = implode(',',$request->input('subcategory_id'));
      }
      if($request->input('group_id')!=null){
        $group = implode(',',$request->input('group_id'));
      }
      if($request->input('type_id')!=null){
        $type = implode(',',$request->input('type_id'));
      }
      $promotion = Promotion::where('id',$id)->first();
      $promotion->code=$request->input('code');
      $promotion->description=$request->input('description');
      $promotion->time_start=$request->input('time_start');
      $promotion->time_end=$request->input('time_end');
      $promotion->qty=$request->input('qty');
      $promotion->disc1=$request->input('disc');
      $promotion->disc2=$request->input('disc2');
      $promotion->qty=$request->input('qty');
      $promotion->unit_id=$request->input('unit_id');
      $promotion->customer_group=$customer_group;
      $promotion->product=$product_id;
      $promotion->brand=$brand_id;
      $promotion->category=$category_id;
      $promotion->sub_category=$sub_cat;
      $promotion->product_type=$type;
      $promotion->product_group=$group;
      $promotion->updated_by=$request->session()->get('user_id')['id'];
      $save = $promotion->update();
        if($save){
          return Response()->json(
              ['status' => true, 'msg' => 'Data has updated!','type'=>'success','title'=>'Success']
          );
        }else {
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function addData(Request $request){
      //print_r($_POST);
      $product_id = 0;
      $brand_id = 0;
      $category_id = 0;
      $sub_cat = 0;
      $customer_group = 0;
      $type = 0;
      $group = 0;
      if($request->input('product_id')!=null){
        $product_id = implode(',',$request->input('product_id'));
      }
      if($request->input('customer_group_id')!=null){
        $customer_group = implode(',',$request->input('customer_group_id'));
      }
      if($request->input('category_id')!=null){
        $category_id = implode(',',$request->input('category_id'));
      }
      if($request->input('category_id')!=null){
        $category_id = implode(',',$request->input('category_id'));
      }
      if($request->input('brand_id')!=null){
        $brand_id = implode(',',$request->input('brand_id'));
      }
      if($request->input('subcategory_id')!=null){
        $sub_cat = implode(',',$request->input('subcategory_id'));
      }
      if($request->input('group_id')!=null){
        $group = implode(',',$request->input('group_id'));
      }
      if($request->input('type_id')!=null){
        $type = implode(',',$request->input('type_id'));
      }
      $promotion = new Promotion();
      $promotion->code=$request->input('code');
      $promotion->description=$request->input('description');
      $promotion->time_start=$request->input('time_start');
      $promotion->time_end=$request->input('time_end');
      $promotion->qty=$request->input('qty');
      $promotion->disc1=$request->input('disc');
      $promotion->disc2=$request->input('disc2');
      $promotion->qty=$request->input('qty');
      $promotion->unit_id=$request->input('unit_id');
      $promotion->customer_group=$customer_group;
      $promotion->product=$product_id;
      $promotion->brand=$brand_id;
      $promotion->category=$category_id;
      $promotion->sub_category=$sub_cat;
      $promotion->product_type=$type;
      $promotion->product_group=$group;
      $promotion->updated_by=$request->session()->get('user_id')['id'];
      $save = $promotion->save();
        if($save){
          return Response()->json(
              ['status' => true, 'msg' => 'Data has added!','type'=>'success','title'=>'Success']
          );
        }else {
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
}
