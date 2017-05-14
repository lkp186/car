<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Area_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    //网点分布界面
    public function index(){
        $all=Area_info::all();
        $arr=array();
        foreach ($all as $value){
            array_push($arr,urlencode($value->area_name_road));
        }
        $json=json_encode($arr,true);
        $newPoint=urldecode($json);
        return view('home.map',['newPoint'=>$newPoint]);
    }
}
