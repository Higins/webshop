<?php
namespace app\helper;

class Helpers {

    public static function array_icount_values($arr,$lower=true) {
        $arr2=array();
        if(!is_array($arr[0])){$arr=array($arr);}
        foreach($arr as $k=> $v){
         foreach($v as $v2){
            if($lower==true) {$v2=strtolower($v2);}
                if(!isset($arr2[$v2])){
                    $arr2[$v2]=1;
                }else{
                    $arr2[$v2]++;
                }
         }
       }
       return $arr2;
   }
}