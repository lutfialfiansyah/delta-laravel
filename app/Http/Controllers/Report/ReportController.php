<?php

namespace App\Http\Controllers\Report;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReportController extends Controller
{
    //
    public function getReport($id){
        $report = DB::table('design_report')
            ->where('id',$id)
            ->get();
        return $report[0]->format;
    }
    public function updateReport(Request $req){
        $json = $req->input('json');
        $id = $req->input('id');
        $report = DB::table('design_report')
            ->where('id',$id)
            ->update([
                "format"=>$json,
                "updated_at"=>Carbon::now()
            ]);
        return Response()->json(
            ['status' => true, 'msg' => 'data has updated','type'=>'success']
        );
    }
    public function getSchema(){
        $data = Schema::getColumnListing("cjournal");
        $cols = array();
        for($i=0;$i<count($data);$i++){
            $col['name']=$data[$i];
            $type = Schema::getColumnType("cjournal",$data[$i]);
            $col['type']=$type;
            array_push($cols,$col);
        }
        return Response()->json([
            'fields'=>$cols
        ]);
    }
    public function getAllData(){
        $report = DB::table('cjournal')->get();
        return Response()->json($report);
    }
}
