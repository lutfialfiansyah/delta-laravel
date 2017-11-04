<?php

namespace App\Http\Controllers;

use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;


class EmployeeController extends Controller
{


    public function getData(){
        $ap=Employee::all();
        return Datatables::of($ap)
            ->addColumn('name',function($ap){
                return $ap->first_name." ".$ap->last_name;
            })
            ->addColumn('action', function ($ap) {
                return
                    '<div class="btn-group">
                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li>
                                                <a href="#" data-id="'.$ap->id.'"
                                                   data-code="'.$ap->code.'"
                                                   data-fname="'.$ap->first_name.'"
                                                   data-lname="'.$ap->last_name.'"
                                                   data-branch="'.$ap->branch_id.'"
                                                   data-email="'.$ap->email.'"
                                                   data-bdate="'.$ap->birth_date.'"
                                                   data-bplace="'.$ap->birth_place.'"
                                                   data-code="'.$ap->code.'" data-toggle="modal" class="stockedit">
                                                    <i class="icon-tag"></i> Edit </a>
                                            </li>
                                            <li>
                                                <a href="#" class="delete" data-id="'.$ap->id.'">
                                                    <i class="icon-docs"></i> Delete </a>
                                            </li>
                                        </ul>
                                    </div>';
            })
            ->make(true);
    }
    public function addData(Request $request){
        if($request->input('password')<>$request->input('cpassword')){
            return Response()->json(
                ['status' => false, 'msg' => 'Password & confirm password don\'t match', 'type' => 'warning', 'title' => 'Ops']
            );
            exit();
        }
        $cek = DB::table('employee')
            ->select(DB::raw('count(*) as cproduct'))
            ->where('email','=',$request->input('email'))
            ->groupBy('email')
            ->get()
            ->first();
        //echo  json_encode($cek);
        if(isset($cek->cproduct)){
            return Response()->json(
                ['status' => false, 'msg' => 'data already exists!', 'type' => 'warning', 'title' => 'Ops']
            );
            exit;
        }
        $session = $request->session()->get('user_id');
        $emp= new Employee();
        $emp->employee_no=$request->input('code');
        $emp->first_name=$request->input('first_name');
        $emp->last_name=$request->input('last_name');
        $emp->email=$request->input('email');
        $emp->branch_id=$request->input('branch');
        $emp->gender=$request->input('gender');
        $emp->birth_place=$request->input('bplace');
        $emp->birth_date=$request->input('bdate');
        $emp->updated_by=$session['id'];
        if($emp->save()){
            $id=$emp->id;
            // DB::table('users')->insert([
            //     'employee_id'=>$id,
            //     'email'=>$request->input('email'),
            //     'password'=>bcrypt($request->input('password')),
            //     'created_at'=>Carbon::now(),
            //     'updated_by'=>$request->input('user_id')
            // ]);
            return Response()->json(
                ['status' => true, 'msg' => 'Data has added!','type'=>'success','title'=>'Success']
            );
        }else {
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function updateData(Request $request,$id){
        $session = $request->session()->get('user_id');
        $emp= Employee::find($id)->first();
        $emp->employee_no=$request->input('code');
        $emp->first_name=$request->input('first_name');
        $emp->last_name=$request->input('last_name');
        $emp->email=$request->input('email');
        $emp->gender=$request->input('gender');
        $emp->birth_place=$request->input('bplace');
        $emp->birth_date=$request->input('bdate');
        $emp->updated_by= $session['id'];
        $emp->branch_id=$request->input('branch');
        if($request->input('password')<>'' or $request->input('cpassword')<>''){
            if($request->input('password')<>$request->input('cpassword')){
                return Response()->json(
                    ['status' => false, 'msg' => 'Password & confirm password don\'t match', 'type' => 'warning', 'title' => 'Ops']
                );
                exit();
            }
            DB::table('users')->where('id',$id)->update(['password'=>$request->input('password')]);
        }
        if($emp->update()){
            DB::table('users')->where('id',$id)->update(['email'=>$request->input('email')]);
            return Response()->json(
                ['status' => true, 'msg' => 'Data has updated!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!', 'type' => 'warning', 'title' => 'Ops']
            );
        }
    }
    public function getAllData(Request $request){
      $data = DB::table('employee')->
              where('employee_no','like','%'.$request->get('code').'%')->get();
      return Response()->json([
          'data'=>$data
      ]);
    }
}
