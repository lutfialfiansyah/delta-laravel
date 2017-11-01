<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use App\ProductSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Services\DataTable;

class SubCategoryController extends Controller
{
    public function getData(Request $request)
    {
        $subCategory = ProductSubCategory::query()
            ->select([
                'product_sub_category.id as id',
                'product_sub_category.category_id as category_id',
                'product_sub_category.code as code',
                'product_sub_category.name as name',
                'product_sub_category.created_at as created_at',
                'product_sub_category.updated_at as updated_at',
                'product_category.name as category_name'
            ])->leftJoin('product_category', 'product_sub_category.category_id', '=', 'product_category.id')->get();
//        echo json_encode($subCategory); exit();
        $datatables = Datatables::of($subCategory);
        return $datatables
            ->addColumn('action', function ($subcategory) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#" data-id="' . $subcategory->id . '" data-catid="' . $subcategory->category_id . '" data-name="' . $subcategory->name . '" data-toggle="modal" class="btnTriggerEdit">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#" id="btnDelete" data-id="' . $subcategory->id . '" class="btnTriggerDelete">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);

    }

    public function addData(Request $request)
    {
        $subcat = new ProductSubCategory();
        $subcat->code = $request->input('code');
        $subcat->category_id = $request->input('category_id');
        $subcat->name = $request->input('subcatname');
        $subcat->created_at = Carbon::now('Asia/Jakarta');
        $this->save = 0;
//        echo json_encode($subcat); exit();
        $checks = ProductSubCategory::all();
        foreach ($checks as $check) {
            if (strtolower($subcat->name) == strtolower($check->name)) {
                $this->save++;
                return response()->json([
                    'status' => false,
                    'text' => 'Sub category already exists!',
                    'type' => 'warning',
                    'title' => 'Ops',
                    'button' => 'btn-success'
                ]);
            }
        }
        if ($this->save == 0) {
            $subcat->save();
            if ($subcat->save()) {
                return response()->json([
                    'status' => true,
                    'title' => 'Success',
                    'text' => 'Sub category has added!',
                    'type' => 'success',
                    'button' => 'btn-success'
                ]);
            }
        }
    }

    public function updateData(Request $request, $id)
    {
        $subcat = ProductSubCategory::find($id);
        $subcat->name = $request->input('subcatname');
        $subcat->category_id = $request->input('category_id');
        $subcat->updated_at = Carbon::now('Asia/Jakarta');
        $this->save = 0;
        $checks = ProductSubCategory::all();
        foreach ($checks as $check) {
            if (strtolower($subcat->name) == strtolower($check->name)) {
                $this->save = $this->save++;
                return response()->json([
                    'status' => false,
                    'text' => 'Sub category already exists!',
                    'type' => 'warning',
                    'title' => 'Ops',
                    'button' => 'btn-success'
                ]);
            }
        }
        if ($this->save == 0) {
            $subcat->save();
            if ($subcat->save()) {
                return response()->json([
                    'status' => true,
                    'title' => 'Success',
                    'text' => 'Category has updated!',
                    'type' => 'success',
                    'button' => 'btn-success'
                ]);
            }
        }
    }

    public function deleteData(Request $request, $id)
    {
        $subcat = ProductSubCategory::find($id);
        $subcat->delete();
        return response()->json([
            'status' => true,
            'title' => 'Success',
            'text' => 'Category has deleted!',
            'type' => 'success',
            'button' => 'btn-success'
        ]);
    }
    public function getAllData(Request $request){
        $data = ProductSubCategory::where('code','like','%'.$request->get('name').'%')
        ->where('category_id','=',$request->get('id_cat'))->get();
        return response()->json(['data'=>$data]);
    }
}
