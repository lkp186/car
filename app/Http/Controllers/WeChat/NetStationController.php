<?php

namespace App\Http\Controllers\WeChat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NetStationController extends Controller
{
    //网点分布
    public function netStation(){
        $all=Area_info::all();
        $arr=array();
        foreach ($all as $value){
            array_push($arr,urlencode($value->area_name_road));
        }
        $json=json_encode($arr,true);
        $newPoint=urldecode($json);
        return view('weixin.netStation',['newPoint'=>$newPoint]);
    }
}
