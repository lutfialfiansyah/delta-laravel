<?php

namespace App\Http\Controllers;

use App\CoaList;
use App\CoaPivotParent;
use App\CoaType;
use App\JournalEntry;
use App\ProductCategory;
use App\ProductSubCategory;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;

class PdfController extends Controller
{
    public function tree()
    {
        $coa_list = CoaList::all();
//        $new = [];
//        foreach ($coa_list as $cl) {
//            $new[$cl['coa_parent_id']][] = $cl;
//        }
//        $tree = $this->createTree($new, array($coa_list[0]));
//
//        echo json_encode($coa_list);
//        exit();


        //SUM
        $aset_list = CoaList::where('code', 'like', '1' . '%')->orderBy('code')->get();
        $journal_entry = JournalEntry::all();

        $je_aset = array();
        $je_asett = array();
        foreach ($journal_entry as $key => $je) {
            foreach ($aset_list as $as) {
                if ($je->coa_list_id == $as->id) {
                    $je_aset[] = $je;
                }
            }
        }


        $je_aset_sum = [];
        foreach ($je_aset as $je) {
            if (array_key_exists($je['coa_list_id'], $je_aset_sum)) {
                $je_aset_sum[$je['coa_list_id']]['credit_total'] += $je['credit_total'];
                $je_aset_sum[$je['coa_list_id']]['debit_total'] += $je['debit_total'];
                $je_aset_sum[$je['coa_list_id']]['coa_list_id'] = $je['coa_list_id'];
            } else {
                $je_aset_sum[$je['coa_list_id']] = $je;
            }
        }
        $je_aset_summ = [];
        foreach ($je_aset_sum as $jko) {
            array_push($je_aset_summ, [
                'id' => $jko['id'],
                'coa_list_id' => $jko['coa_list_id'],
                'debit_total' => $jko['debit_total'],
                'credit_total' => $jko['credit_total']
            ]);
        }
//        echo json_encode($je_aset_summ);exit();

        $tree = [];
        $debit = null;
        $credit = null;
        $c = count($je_aset_summ);
//        echo $c; exit();
        foreach ($coa_list as $key => $coa_val) {
            for ($i = 0; $i < $c; $i++) {
//                echo $je_val->coa_list_id . "<br>";
//                echo $je_val->coa_list_id . " vs ". $choa_val->id . "<br>" . "<hr>";
                if ($coa_val->id == $je_aset_summ[$i]['coa_list_id']) {
                    $debit = $je_aset_summ[$i]['debit_total'];
                    $credit = $je_aset_summ[$i]['credit_total'];
                } else {
                    $debit = 0;
                    $credit = 0;
                }
            }
            array_push($tree, [
                "id" => $coa_val->id,
                "coa_type_id" => $coa_val->coa_type_id,
                "code" => $coa_val->code,
                "name" => $coa_val->name,
                "coa_parent_id" => $coa_val->coa_parent_id,
                "parent_status" => $coa_val->parent_status,
                "debit_total" => $debit,
                "credit_total" => $credit
            ]);
        }


        //TREE
        $new = [];
        foreach ($tree as $cl) {
            $new[$cl['coa_parent_id']][] = $cl;
        }
        $trees = $this->createTree($new, array($tree[0]));

        $new = [];
        foreach ($tree as $cl) {
            $new[$cl['coa_parent_id']][] = $cl;
        }
        $trees2 = $this->createTree($new, array($tree[11]));



//        $new = [];
//        foreach ($coa_list as $cl) {
//            $new[$cl['coa_parent_id']][] = $cl;
//        }
//        $tree = $this->createTree($new, array($coa_list[0]));

        dd($trees2);
        exit();
    }

    public function createTree(&$list, $parent)
    {
        $tree = [];
        foreach ($parent as $key => $l) {
            if (isset($list[$l['id']])) {
                $l['child'] = $this->createTree($list, $list[$l['id']]);
            }
            $tree[] = $l;
        }
        return $tree;
    }


    public function neracas()
    {
        $aset_list = CoaList::where('code', 'like', '1' . '%')->orderBy('code')->get();
        $journal_entry = JournalEntry::all();
        $types = CoaType::whereBetween('code', [100, 400])->get();
        $pivots = CoaPivotParent::all();

        $je_aset = array();
        foreach ($journal_entry as $key => $je) {
            foreach ($aset_list as $as) {
                if ($je->coa_list_id == $as->id) {
                    $je_aset[] = $je;
                }
            }
        }
        $je_aset_sum = [];
        foreach ($je_aset as $je) {
            if (array_key_exists($je['coa_list_id'], $je_aset_sum)) {
                $je_aset_sum[$je['coa_list_id']]['credit_total'] += $je['credit_total'];
                $je_aset_sum[$je['coa_list_id']]['debit_total'] += $je['debit_total'];
                $je_aset_sum[$je['coa_list_id']]['coa_list_id'] = $je['coa_list_id'];
            } else {
                $je_aset_sum[$je['coa_list_id']] = $je;
            }
        }

//        exit();
    }

    public function asets(){
        $cl_kb = CoaList::where('code','like','111'.'%')
            ->orderBy('code')
        ->get();


        $journal_entry = JournalEntry::all();

        $je_aset = array();
        foreach ($journal_entry as $key => $je) {
            foreach ($cl_kb as $as) {
                if ($je->coa_list_id == $as->id) {
                    $je_aset[] = $je;
                }
            }
        }
        $je_aset_sum = [];
        foreach ($je_aset as $je) {
            if (array_key_exists($je['coa_list_id'], $je_aset_sum)) {
                $je_aset_sum[$je['coa_list_id']]['credit_total'] += $je['credit_total'];
                $je_aset_sum[$je['coa_list_id']]['debit_total'] += $je['debit_total'];
                $je_aset_sum[$je['coa_list_id']]['coa_list_id'] = $je['coa_list_id'];
            } else {
                $je_aset_sum[$je['coa_list_id']] = $je;
            }
        }


//        echo json_encode($cl_kb);
//        exit();
    }
    public function neraca(){
        $aset_lancar = DB::table('vw_journal_entry as a')
            ->groupBy('a.coa_parent_id')
            ->selectRaw('*,sum(debit_total) as debit, sum(credit_total) as credit')
            ->where('code','like','11'.'%')
            ->get();
        $aset_tidak_lancar = DB::table('vw_journal_entry as a')
            ->groupBy('a.coa_parent_id')
            ->selectRaw('*,sum(debit_total) as debit, sum(credit_total) as credit')
            ->where('code','like','12'.'%')
            ->get();
        $kewajiban = DB::table('vw_journal_entry as a')
            ->groupBy('a.coa_parent_id')
            ->selectRaw('*,sum(debit_total) as debit, sum(credit_total) as credit')
            ->where('code','like','21'.'%')
            ->get();
        $ekuitas = DB::table('vw_journal_entry as a')
            ->groupBy('a.coa_parent_id')
            ->selectRaw('*,sum(debit_total) as debit, sum(credit_total) as credit')
            ->where('code','like','22'.'%')
            ->get();

        echo json_encode($aset_lancar);
        exit();
    }
    public function jsReport($id){
        return view("modules.dashboard.jsReport",compact('id'));
    }
    public function jsReportNeraca(){
        return view("modules.dashboard.jsReportNeraca");
    }
    public function jsReportViewNeraca(){
        $dataGroup = DB::table("coa_list")
            ->where('coa_parent_id','=','0')
            ->whereIn('coa_type_id',[1,2,3,4])
            ->get();
        $dataGroup2 = DB::table("coa_list")
            ->where('coa_parent_id','=','0')
            ->whereIn('coa_type_id',[5,6])
            ->get();
        $dataGroup3 = DB::table("coa_list")
            ->where('coa_parent_id','=','0')
            ->whereIn('coa_type_id',[7,8])
            ->get();
        $dataGroup4 = DB::table("coa_list")
            ->where('coa_parent_id','=','0')
            ->whereIn('coa_type_id',[8])
            ->get();
        $arrgroup = array();
        $arrgroup2 = array();
        $arrgroup3 = array();
        $arrgroup4 = array();
        $sumalltotal1=0;
        $sumalltotal2=0;
        $sumalltotal3=0;
        $sumalltotal4=0;
        foreach ($dataGroup as $row){
            $item['type']=$row->name;
            $data = DB::table('vw_journal_entry as a')
                ->join("coa_list as b",'a.code5','=','b.code')
                ->groupBy('a.code5')
                ->selectRaw('*,sum(a.debit_total) as debit, sum(a.credit_total) as credit')
                ->where('a.coa_type_id' ,'=', $row->coa_type_id)
                ->get();
                $arrdata=array();
                $total=0;
                foreach ($data as $row2){
                    $dataItem['name'] = $row2->name;
                    $dataItem['total'] = $row2->credit - $row2->debit;
                    array_push($arrdata, $dataItem);
                    $total += $dataItem['total'];
                }
            $item['item']=$arrdata;
            $item['sumtotal'] = $total;
            $sumalltotal1 += $item['sumtotal'];
            array_push($arrgroup,$item);
        }
        foreach ($dataGroup2 as $row){
            $item['type']=$row->name;
            $data = DB::table('vw_journal_entry as a')
                ->join("coa_list as b",'a.code5','=','b.code')
                ->groupBy('a.code5')
                ->selectRaw('*,sum(a.debit_total) as debit, sum(a.credit_total) as credit')
                ->where('a.coa_type_id' ,'=', $row->coa_type_id)
                ->get();
            $arrdata2=array();
            $total=0;
            foreach ($data as $row2){
                $dataItem['name'] = $row2->name;
                $dataItem['total'] = $row2->credit - $row2->debit;
                array_push($arrdata2, $dataItem);
                $total += $dataItem['total'];
            }
            $item['item']=$arrdata2;
            $item['sumtotal'] = $total;
            $sumalltotal2 += $item['sumtotal'];
            array_push($arrgroup2,$item);
        }
        $sumaset = $sumalltotal1 + $sumalltotal2;
        foreach ($dataGroup3 as $row){
            $data = DB::table('vw_journal_entry as a')
                ->join("coa_list as b",'a.code5','=','b.code')
                ->groupBy('a.code5')
                ->selectRaw('*,sum(a.debit_total) as debit, sum(a.credit_total) as credit')
                ->where('a.coa_type_id' ,'=', $row->coa_type_id)
                ->get();
            $arrdata3=array();
            $total=0;
            foreach ($data as $row2){
                $dataItem['name']=$row2->name;
                $dataItem['total']=$row2->credit - $row2->debit;
                array_push($arrdata3,$dataItem);
                $total += $dataItem['total'];
            }
            $item['item']=$arrdata3;
            $item['sumtotal'] = $total;
            $sumalltotal3 += $item['sumtotal'];
            array_push($arrgroup3,$item);
        }
        foreach ($dataGroup4 as $row){
            $data = DB::table('vw_journal_entry as a')
                ->join("coa_list as b",'a.code5','=','b.code')
                ->groupBy('a.code5')
                ->selectRaw('*,sum(a.debit_total) as debit, sum(a.credit_total) as credit')
                ->where('a.coa_type_id' ,'=', $row->coa_type_id)
                ->get();
            $arrdata4=array();
            $total=0;
            foreach ($data as $row2){
                $dataItem['name']=$row2->name;
                $dataItem['total']=$row2->credit - $row2->debit;
                array_push($arrdata4,$dataItem);
                $total += $dataItem['total'];
            }
            $item['item']=$arrdata4;
            $item['sumtotal'] = $total;
            $sumalltotal4 += $item['sumtotal'];
            array_push($arrgroup4,$item);
        }
        $sumkewajiban = $sumalltotal3 + $sumalltotal4;

        $response = Curl::to('http://103.200.7.58:5488/api/report/')
            ->withHeader('Content-Type : application/json')
            ->withData( array(
                    'template' =>array('shortid'=>'rkWJgjShZ'),
                    "options"=>array('preview'=>true),
                    "data"=>
                        array(
                            "tgl" =>\Date('d-m-Y'),
                            "types"=>$arrgroup,
                            "types2"=>$arrgroup2,
                            "types3"=>$arrgroup3,
                            "types4"=>$arrgroup4,
                            "sumalltotal"=>$sumalltotal1,
                            "sumalltotal2"=>$sumalltotal2,
                            "sumalltotal3"=>$sumalltotal3,
                            "sumalltotal4"=>$sumalltotal4,
                            "sumaset"=>$sumaset,
                            "sumkewajiban"=>$sumkewajiban
                        )
                )
            )
            ->asJsonRequest()
            ->post();
        return response($response)
            ->header('Content-Type', 'application/pdf');
    }
    public function jsReportLabaRugi(){
        return view("modules.dashboard.jsReportLabaRugi");
    }
    public function jsReportViewLabaRugi(){
        $dataGroup = DB::table("coa_list")
            ->whereNull('coa_parent_id')
            ->whereIn('coa_type_id',[9,10,11,12,13])
            ->get();

        $arrgroup = array();
        foreach ($dataGroup as $row){
            $item['type']=$row->name;
            $data = DB::table('vw_journal_entry')
                ->groupBy('coa_parent_id')
                ->selectRaw('*,sum(debit_total) as debit, sum(credit_total) as credit')
                ->where('coa_type_id' ,'=', $row->coa_type_id)
                ->get();
            $arrdata=array();
            $totalcredit=0;
            $totaldebit=0;
            foreach ($data as $row2){
                $dataItem['name']=$row2->name;
                $dataItem['debit']=$row2->debit;
                $dataItem['credit']=$row2->credit;
                array_push($arrdata,$dataItem);
                $totaldebit += $row2->debit;
                $totalcredit += $row2->credit;
            }
            $item['item']=$arrdata;
            $item['totaldebit']=$totaldebit;
            $item['totalcredit']=$totalcredit;
            array_push($arrgroup,$item);
        }
        $response = Curl::to('http://103.200.7.58:5488/api/report/')
            ->withHeader('Content-Type : application/json')
            ->withData( array(
                    'template' =>array('shortid'=>'B1WFx6q3-'),
                    "options"=>array('preview'=>true),
                    "data"=>
                        array(
                            "tgl" =>\Date('d-m-Y'),
                            "types"=>$arrgroup
                        )
                )
            )
            ->asJsonRequest()
            ->post();
        return response($response)
            ->header('Content-Type', 'application/pdf');

    }
    public function jsReportView($id){
            $data= DB::table('purchase_transaction as a')
                ->join('vendor as b','a.vendor_id','=','b.id')
                ->where('a.id',$id)
                ->first();
            $dataprice = DB::table("purchase_transaction_detail as a")
                ->join('product as b','a.product_id','=','b.id')
                ->where('a.purchase_id','=',$id)
                ->get();
            $items=array();
            foreach ($dataprice as $row){
                $item['name']=$row->name;
                $item['qty']=$row->qty;
                $item['price']=$row->price;
                $item['totals']=$row->price*$row->qty;
                array_push( $items,$item);
            }
         //   print_r($items);
       // exit;
            //print_r($data[0]->purchase_transaction_no);
            //exit;

            $response = Curl::to('http://103.200.7.58:5488/api/report/')
           ->withHeader('Content-Type:application/json')
           ->withData( array(
               'template' =>array('shortid'=>'rkJTnK2ce'),
               "options"=>array('preview'=>true),
               "data"=>
                   array(
                       "number" =>$data->purchase_transaction_no,
                       "seller" =>array(
                           "name"=>"PT. Mega visi prima jaya",
                            "road"=>"jl Pengadilan ",
                            "country"=>"(0251) 000000"
                       ),
                       "buyer" =>array(
                           "name"=>$data->name,
                           "road"=>$data->address,
                           "country"=>$data->phone_1
                       ),
                       "items" =>$items
                   )
                )
           )
                ->asJsonRequest()
           ->post();
            return response($response)
            ->header('Content-Type', 'application/pdf');
    }
    public function jsReportFaktur($id){
        return view("modules.dashboard.jsReportFaktur",compact('id'));
    }
    public function jsReportViewFaktur(){

    }

}
