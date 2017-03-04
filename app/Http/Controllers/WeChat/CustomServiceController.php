<?php

namespace App\Http\Controllers\WeChat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomServiceController extends Controller
{
    //获取access_token
    public function get_access_token(){
        $app_id="wxbbfbbbe89c83625b";
        $app_secret="fa684ef8617d8908ccff7ca778d51ebc";
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$app_id&secret=$app_secret";
        $json=http_request($url);
        $attr=json_decode($json,true);
        return $attr['access_token'];
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
