<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{
    //
    public function getData(Request $request)
    {
          $users = DB::table('users as a')
                    ->leftjoin('Employee as b','a.employee_id','=','b.id')
                    ->select('a.id','b.first_name','b.last_name','a.email','b.employee_no')
                    ->get();
          return Datatables::of($users)
              ->addColumn('action', function ($users) {
                  return
                      '<div class="btn-group">
                                      <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                          <i class="fa fa-angle-down"></i>
                                      </button>
                                      <ul class="dropdown-menu pull-right" role="menu">
                                          <li>
                                              <a href="" data-toggle="modal">
                                                  <i class="icon-tag"></i> Detail </a>
                                          </li>
                                          <li>
                                              <a href="#" class="delete" data-id="">
                                                  <i class="icon-docs"></i> Delete </a>
                                          </li>
                                      </ul>
                                  </div>';
              })
              ->make(true);
    }
    public function addData(Request $req){
        $save = DB::table('users')->insert([
          'employee_id'=>$req->input('employee_id'),
          'email'=>$req->input('email'),
          'password'=>bcrypt($req->input('password'))
        ]);
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
