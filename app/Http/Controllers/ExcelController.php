<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Helpers\MegaTrend;
use App\Product;
use App\ProductSubCategory;
use App\StockBeginning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function exportProduct($type)
    {
        $data = DB::table('product as p')
            ->select('p.id as id', 'p.item_no as item_no', 'p.code as code', 'p.name as name', 'u.id as unit_id', 'u.name as unit_name', 't.id as type_id', 't.name as type_name', 'c.id as category_id', 'c.name as category_name', 'sc.id as sub_cat_id', 'sc.name as sub_cat_name', 'b.id as brand_id', 'b.name as brand_name', 'g.id as group_id', 'g.name as group_name', 'p.max_payment_periode', 'p.stock_minimum', 'v.summarystock as summary_stock')
            ->join('unit as u', 'u.id', '=', 'p.unit_id')
            ->join('product_type as t', 't.id', '=', 'p.type_id')
            ->join('product_category as c', 'c.id', '=', 'p.category_id')
            ->join('product_sub_category as sc', 'sc.id', '=', 'p.sub_cat_id')
            ->join('product_brand as b', 'b.id', '=', 'p.brand_id')
            ->join('product_group as g', 'g.id', '=', 'p.group_id')
            ->leftjoin('vw_summary_stock as v', 'v.product_id', '=', 'p.id')
            ->where('p.deleted_at', '=', null)
            ->get();
        $data = collect($data)->map(function ($x) {
            return (array)$x;
        })
            ->toArray();
        return Excel::create('Master Product', function ($excel) use ($data) {
            $excel->sheet('Sheet 1', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function importProduct()
    {
        if (Input::hasFile('import_excel')) {
            $path = Input::file('import_excel')->getRealPath();
            $data = Excel::load($path, function ($reader) {
                $reader->select(array('id', 'item_no', 'code', 'name', 'unit_id', 'type_id', 'category_id', 'sub_cat_id', 'brand_id', 'group_id', 'max_payment_periode', 'stock_minimum'));
            })->get();
            if (!empty($data)) {
                foreach ($data as $key => $value) {
                    $cek = DB::table('product')->where('id', $value->id)->first();
                    if (empty($cek)) {
//                        echo "insert";
                        $new_product = new Product();
                        if ($value->item_no == null){
                            $new_product->item_no = 0;
                        }else{
                            $new_product->item_no = $value->item_no;
                        }
                        $new_product->code = MegaTrend::getLastCode('PR', 'product', 'code');
                        $new_product->name = $value->name;
                        $new_product->unit_id = $value->unit_id;
                        $new_product->type_id = $value->type_id;
                        $new_product->category_id = $value->category_id;
                        $new_product->sub_cat_id = $value->sub_cat_id;
                        $new_product->brand_id = $value->brand_id;
                        $new_product->group_id = $value->group_id;
                        $new_product->max_payment_periode = $value->max_payment_periode;
                        $new_product->stock_minimum = $value->stock_minimum;
                        $new_product->save();
                    } else {
                        $cek2 = DB::table('product')
                            ->where('id', $value->id)
                            ->where('deleted_at', '!=', null)
                            ->first();
                        if (empty($cek2)) {

//                        echo "-update";
                            $update_product = Product::find($value->id);
                            $update_product->item_no = $value->item_no;
                            $update_product->code = $value->code;
                            $update_product->name = $value->name;
                            $update_product->unit_id = $value->unit_id;
                            $update_product->type_id = $value->type_id;
                            $update_product->category_id = $value->category_id;
                            $update_product->sub_cat_id = $value->sub_cat_id;
                            $update_product->brand_id = $value->brand_id;
                            $update_product->group_id = $value->group_id;
                            $update_product->max_payment_periode = $value->max_payment_periode;
                            $update_product->stock_minimum = $value->stock_minimum;
                            $update_product->update();
                        }
                    }
                }
                return response()->json([
                    'status' => true,
                    'title' => 'Success',
                    'text' => 'Product has updated!',
                    'type' => 'success',
                    'button' => 'btn-success'
                ]);
            }
        }
    }

    public function exportCustomer($type)
    {
        $data = DB::table('customer as a')
            ->select('a.id as id', 'a.code as code', 'a.name as name', 'a.branch_id as branch_id', 'b.description as branch_description', 'a.customer_group_id as customer_group_id', 'c.description as customer_group_description', 'a.area_city_id as area_city_id', 'a.salesman_id as salesman_id', 'e.code as salesman_code', 'a.payment_term_id as payment_term_id', 'f.name as payment_term_name')
            ->join('branch as b', 'a.branch_id', '=', 'b.id')
            ->join('customer_group as c', 'a.customer_group_id', '=', 'c.id')
//            ->join('area_city as d','a.area_city_id','=','d.id')
            ->join('salesman as e', 'a.salesman_id', '=', 'e.id')
            ->join('payment_term as f', 'a.payment_term_id', '=', 'f.id')
            ->where('a.deleted_at', '=', null)
            ->get();
        $data = collect($data)->map(function ($x) {
            return (array)$x;
        })
            ->toArray();
        return Excel::create('Master Customer', function ($excel) use ($data) {
            $excel->sheet('Sheet 1', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function importCustomer()
    {
        if (Input::hasFile('import_excel')) {
            $path = Input::file('import_excel')->getRealPath();
            $data = Excel::load($path, function ($reader) {
                $reader->select(array('id', 'code', 'name', 'branch_id', 'customer_group_id', 'area_city_id', 'salesman_id', 'payment_term_id'));
            })->get();
            if (!empty($data)) {
                foreach ($data as $key => $value) {
                    $cek = DB::table('customer')->where('id', $value->id)->first();
                    if (empty($cek)) {
//                        echo "insert";
                        $new_customer = new Customer();
                        $new_customer->code = MegaTrend::getLastCode('C', 'customer', 'code');
                        $new_customer->name = $value->name;
                        $new_customer->branch_id = $value->branch_id;
                        $new_customer->customer_group_id = $value->customer_group_id;
                        $new_customer->area_city_id = $value->area_city_id;
                        $new_customer->salesman_id = $value->salesman_id;
                        $new_customer->payment_term_id = $value->payment_term_id;
                        $new_customer->save();
                    } else {
                        $cek2 = DB::table('customer')->where('id', $value->id)
                            ->where('deleted_at', '!=', null)
                            ->first();
                        if (empty($cek2)) {
//                        echo "-update";
                            $update_customer = Customer::find($value->id);
                            $update_customer->code = $value->code;
                            $update_customer->name = $value->name;
                            $update_customer->branch_id = $value->branch_id;
                            $update_customer->customer_group_id = $value->customer_group_id;
                            $update_customer->area_city_id = $value->area_city_id;
                            $update_customer->salesman_id = $value->salesman_id;
                            $update_customer->payment_term_id = $value->payment_term_id;
                            $update_customer->update();
                        }
                    }
                }
                return response()->json([
                    'status' => true,
                    'title' => 'Success',
                    'text' => 'Customer has updated!',
                    'type' => 'success',
                    'button' => 'btn-success'
                ]);
            }
        }
    }

    public function importStockBeginning()
    {
        if (Input::hasFile('import_excel')) {
            $path = Input::file('import_excel')->getRealPath();
            $data = Excel::load($path, function ($reader) {
                $reader->select(array('id', 'branch_id', 'product_id', 'qty', 'unit_id', 'cogs_history_start_id', 'cogs_history_end_id'));
            })->get();
            if (!empty($data)) {
                foreach ($data as $key => $value) {
                    $cek = DB::table('stock_beginning')
                        ->where('id', $value->id)
                        ->first();
//                    echo json_encode($cek);
                    if (empty($cek)) {
                        $cek2 = DB::table('stock_beginning')
                            ->where('product_id', $value->product_id)
                            ->first();
                        if (empty($cek2)) {
                            //                        echo "insert";
                            $new_sb = new StockBeginning();
                            $new_sb->branch_id = $value->branch_id;
                            $new_sb->product_id = $value->product_id;
                            $new_sb->qty = $value->qty;
                            $new_sb->unit_id = $value->unit_id;
                            if ($value->cogs_history_start_id == null) {
                                $new_sb->cogs_history_start_id = 0;
                            } else {
                                $new_sb->cogs_history_start_id = $value->cogs_history_start_id;
                            }
                            if ($value->cogs_history_end_id == null) {
                                $new_sb->cogs_history_end_id = 0;
                            } else {
                                $new_sb->cogs_history_end_id = $value->cogs_history_end_id;
                            }
                            $new_sb->save();
                        }
                    } else {
                        $cek3 = DB::table('stock_beginning')
                            ->where('id', $value->id)
                            ->where('deleted_at', '!=', null)
                            ->first();
//                        echo "-update";
                        if (empty($cek3)) {
                            $update_sb = StockBeginning::find($value->id);
                            $update_sb->branch_id = $value->branch_id;
                            $update_sb->product_id = $value->product_id;
                            $update_sb->qty = $value->qty;
                            $update_sb->unit_id = $value->unit_id;
                            $update_sb->cogs_history_start_id = $value->cogs_history_start_id;
                            $update_sb->cogs_history_end_id = $value->cogs_history_end_id;
                            $update_sb->deleted_at = null;
                            $update_sb->update();
                        }
                    }
                }
                return response()->json([
                    'status' => true,
                    'title' => 'Success',
                    'text' => 'Stock beginning has updated!',
                    'type' => 'success',
                    'button' => 'btn-success'
                ]);
            }
        }
    }

    public function cek()
    {
        $update_sb = StockBeginning::withTrashed()->get();
        $a = DB::table('stock_beginning')
            ->get();
        $cek3 = DB::table('stock_beginning')
            ->where('deleted_at', '=', null)
            ->where('id', 1)
            ->get();
        echo json_encode($cek3);
        exit();
    }

}
