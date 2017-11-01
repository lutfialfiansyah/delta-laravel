<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class MegaTrend{
    public static function getLastCode($prefix,$table,$field){
        $date = new \DateTime();
        $code =(array)DB::select("select max(right(".$field.",5)) lastcode from ".$table);
        //$codes= $code[0]->lastcode);
        //exit;
        if(empty($code[0]->lastcode)){
            $code=$prefix."-".date('ym')."00001";
        }else{
             $lastcode = ($code[0]->lastcode)+1;
            if($lastcode<10){
                $lastcode="0000".$lastcode;
            }else if($lastcode<100){
                $lastcode="000".$lastcode;
            }
            else if($lastcode<1000){
                $lastcode="00".$lastcode;
            }
            else if($lastcode<10000){
                $lastcode="0".$lastcode;
            }
            $code = $prefix."-".date('ym').$lastcode;
        }
        return $code;
    }

    public static function getProductItem($prefix,$table,$field){
        $code =(array)DB::select("select max(right(".$field.",5)) lastcode from ".$table);
        //$codes= $code[0]->lastcode);
        //exit;
        if(empty($code[0]->lastcode)){
            $code=$prefix."-"."00000"."00001";
        }else{
             $lastcode = ($code[0]->lastcode)+1;
            if($lastcode<10){
                $lastcode="000".$lastcode;
            }else if($lastcode<100){
                $lastcode="00".$lastcode;
            }
            $code = $prefix."-"."00000".$lastcode;
        }
        return $code;
    }

    function printTree($tree) {
        if(!is_null($tree) && count($tree) > 0) {
            echo '<ul>';
            foreach($tree as $node) {
                echo '<li>'.$node['name'];
                $this->printTree($node['children']);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
}
