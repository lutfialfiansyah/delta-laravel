<?php

namespace App\Http\Controllers\COA;

use App\Models\COA\CoaList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CoaPivotParentController extends Controller
{
    //
    public function getLastCode($parent_code){
      $code=DB::select("select max(right(child_code,2)) last_code from(
select a.coa_parent_id as parent_id,b.name as parent_name,b.code parent_code,a.name as child_name,a.code as child_code from coa_list a
left join coa_list b on a.coa_parent_id =b.id
) a where parent_code='".$parent_code."'");

      $code = $code[0]->last_code;
      if($code<10){
          $lastcode = $parent_code.$code+1;
      }
      return Response()->json(['code'=>$lastcode]) ;
    }

}
