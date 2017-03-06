<?php

namespace App\Http\Controllers\WeChat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WeatherController extends Controller
{
    //向天气api发送请求
    public function index(Request $request){
        $city=urlencode($request->input('city'));
        $url = "https://api.thinkpage.cn/v3/weather/daily.json?key=otkz6bh0xu4za9a3&location=$city&language=zh-Hans&unit=c&start=0&days=5";
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
