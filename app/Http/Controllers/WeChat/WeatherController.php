<?php

namespace App\Http\Controllers\WeChat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WeatherController extends Controller
{
    //向天气api发送请求
    public function index(Request $request){
        $city=$request->input('city');
        $url = "http://api.map.baidu.com/telematics/v3/weather?location="
            .urlencode($city)
            ."&output=json&ak=fdSzO7ivDE0MfeukkwrByrh5Pi0LXihU";
        $json=$this->http_request($url);
        return $json;
    }



    //curl
    public function http_request($url,$data=null){
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
        if(!empty($data)){
            curl_setopt($curl,CURLOPT_POST,1);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$data);

        }
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        $output=curl_exec($curl);
        curl_close($curl);
        return $output;

    }
}
