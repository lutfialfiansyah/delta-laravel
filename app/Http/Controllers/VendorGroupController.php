<?php

namespace App\Http\Controllers;

use App\VendorGroup;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class VendorGroupController extends Controller
{
    //
    public function getData(){
        $vendorGroup = VendorGroup::all();
        return Datatables::of($vendorGroup)
            ->addColumn('action', function ($vendorGroup) {
                return
                    '<div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#" data-id="'.$vendorGroup->id.'"  data-desc="'.$vendorGroup->description.'"  data-name="'.$vendorGroup->name.'" data-toggle="modal" class="groupedit">
                                                <i class="icon-tag"></i> Edit </a>
                                        </li>
                                        <li>
                                            <a href="#" class="delete" data-id="'.$vendorGroup->id.'">
                                                <i class="icon-docs"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>';
            })
            ->make(true);
    }
    public function addData(Request $req){
        $vendorGroup = new VendorGroup;
        $vendorGroup->name = $req->input('groupname');
        $vendorGroup->description = $req->input('description');
        if($vendorGroup->save()) {
            return Response()->json(
                ['status' => true, 'msg' => 'data has added!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
    public function updateData(Request $req,$id){
        $vendorGroup = VendorGroup::where('id',$id)->first();
        $vendorGroup->name = $req->input('groupname');
        $vendorGroup->description = $req->input('description');
        if($vendorGroup->update()) {
            return Response()->json(
                ['status' => true, 'msg' => 'data has updated!','type'=>'success','title'=>'Success']
            );
        }else{
            return Response()->json(
                ['status' => false, 'msg' => 'Something went wrong!','type'=>'warning','title'=>'Ops']
            );
        }
    }
}
