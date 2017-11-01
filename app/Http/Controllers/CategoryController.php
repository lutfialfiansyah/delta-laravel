<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    public function getData(Request $request)
    {
        $category = ProductCategory::all();
        $datatables = Datatables::of($category);
//        return response()->json([$category]);
        return $datatables
            ->addColumn('action', function ($category) {
                return
                    '<div class="btn-group">
                                       <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#" data-id="' . $category->id . '" data-name="'. $category->name .'" data-toggle="modal" class="btnGroupEdit">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#" data-id="' . $category->id . '" class="delete">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);

    }

    public function addData(Request $request)
    {
        $category = New ProductCategory();
        $category->code = $request->input('code');
        $category->name = $request->input('groupName');
        $category->created_at = Carbon::now('Asia/Jakarta');
        $checks = ProductCategory::all();
        $this->save = 0;
        foreach ($checks as $check){
            if (strtolower($category->name) == strtolower($check->name)){
                $this->save++;
                return response()->json([
                    'status' => false,
                    'text' => 'Category already exists!',
                    'type' => 'warning',
                    'title' => 'Ops',
                    'button' => 'btn-success'
                ]);
            }
        }
        if ($this->save == 0){
            $category->save();
            if($category->save()){
                return response()->json([
                    'status' => true,
                    'title' => 'Success',
                    'text' => 'Category has added!',
                    'type' => 'success',
                    'button' => 'btn-success'
                ]);
            }
        }

    }

    public function updateData(Request $request, $id)
    {
        $category = ProductCategory::find($id);
        $category->name = $request->input('groupName');
        $category->updated_at = Carbon::now('Asia/Jakarta');
        $checks = ProductCategory::all();
        $this->save = 0;
        foreach ($checks as $check){
            if (strtolower($category->name) == strtolower($check->name)){
                $this->save++;
                return response()->json([
                    'status' => false,
                    'text' => 'Category already exists!',
                    'type' => 'warning',
                    'title' => 'Ops',
                    'button' => 'btn-success'
                ]);
            }
        }
        if ($this->save == 0) {
            $category->save();
            if ($category->save()) {
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
        $category = ProductCategory::find($id);
        $category->delete();
        return response()->json([
            'status' => true,
            'title' => 'Success',
            'text' => 'Category has deleted!',
            'type' => 'success',
            'button' => 'btn-success'
        ]);
    }

    public function getAllData(Request $request){
        $data = ProductCategory::where('code','like','%'.$request->get('name').'%')->get();
        return Response()->json(['data'=>$data]);
    }
}
