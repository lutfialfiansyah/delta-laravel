<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Employee;
use App\Helpers\MegaTrend;
use App\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class WarehouseController extends Controller
{
    public function insertWarehouse(){
        $code = MegaTrend::getLastCode('WH','warehouse', 'code');
        $employee = Employee::all();
        $branch = Branch::all();
//        $area = Area::all();
        return view('modules.warehouse.insert_warehouse', compact('code','employee','branch'));
    }


    public function getData(Request $request)
    {
        $warehouse = Warehouse::select([
            DB::raw('@rownum := @rownum + 1 AS rownum'),
            'id','branch_id', 'code', 'name', 'description', 'employee_id', 'area_id', 'address'
        ])->get();
        $datatables = Datatables::of($warehouse);
        return $datatables
            ->editColumn('branch_id', function ($warehouse){
                return $warehouse->branch->description;
            })
            ->editColumn('employee_id', function ($warehouse){
                return $warehouse->employee->first_name.' '.$warehouse->employee->last_name;
            })
            ->addColumn('action', function ($warehouse) {
                return
                    '<div class="btn-group">
                                       <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="'.route('warehouse.updateWarehouse',$warehouse->id).'" id="trigerupdate" >
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#" class="trigerdelete" data-id="'.$warehouse->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }

    public function addData(Request $request)
    {
        $warehouse = new Warehouse();
        $warehouse->branch_id = $request->input('branch_id');
        $warehouse->code = $request->input('code');
        $warehouse->name = $request->input('name');
        $warehouse->description = $request->input('description');
        $warehouse->employee_id = $request->input('employee_id');
        $warehouse->area_id = $request->input('area_id');
        $warehouse->address = $request->input('address');
        $warehouse->created_at = Carbon::now('Asia/Jakarta');
        $this->save = 0;
        $checks = Warehouse::all();
        foreach ($checks as $check) {
            if (strtolower($warehouse->name) == strtolower($check->name)) {
                $this->save++;
                return response()->json([
                    'status' => false,
                    'text' => 'Warehouse already exists!',
                    'type' => 'warning',
                    'title' => 'Ops',
                    'button' => 'btn-success'
                ]);
            }
        }
        if ($this->save == 0) {
            $warehouse->save();
            if ($warehouse->save()) {
                return response()->json([
                    'status' => true,
                    'title' => 'Success',
                    'text'   => 'Warehouse has added!',
                    'type' => 'success',
                    'button' => 'btn-success'
                ]);
            }
        }
    }

    public function updateWarehouse($id){
        $warehouse = Warehouse::find($id);
        $branch = Branch::all();
        $employee = Employee::all();
//        echo json_encode($warehouse); exit();
        return view('modules.warehouse.edit_warehouse', compact('warehouse','branch','employee'));
    }

    public function updateData(Request $request, $id){
        $warehouse = Warehouse::find($id);
        $warehouse->branch_id = $request->input('branch_id');
        $warehouse->name = $request->input('name');
        $warehouse->description = $request->input('description');
        $warehouse->employee_id = $request->input('employee_id');
        $warehouse->area_id = $request->input('area_id');
        $warehouse->address = $request->input('address');
        $warehouse->updated_at = Carbon::now('Asia/Jakarta');
        $this->save = 0;
        $checks = Warehouse::all();
        foreach ($checks as $check){
            if (strtolower($warehouse->name) == strtolower($check->name)){
                if ($id != $check->id){
                    $this->save++;
                    return response()->json([
                        'status' => false,
                        'title' => 'Ops',
                        'text' => 'Warehouse already exists!',
                        'type' => 'warning',
                        'button' => 'btn-success'
                    ]);
                }
            }
        }

        if ($this->save == 0) {
            $warehouse->save();
            if ($warehouse->save()){
                return response()->json([
                    'status' => true,
                    'title' => 'Success',
                    'text' => 'Warehouse has updated!',
                    'type' => 'success',
                    'button' => 'btn-success'
                ]);
            }
        }
    }

    public function deleteData($id){
        $warehouse = Warehouse::find($id);
        $warehouse->delete();
        return response()->json([
            'status' => true,
            'title' => 'Success',
            'text' => 'Warehouse has deleted!',
            'type' => 'success',
            'button' => 'btn-success'
        ]);
    }
    public function getAllData(Request $request){
        $data = Warehouse::where('code','like','%'.$request->get('name').'%')->get();
        return Response()->json(['data'=>$data]);
    }
}
