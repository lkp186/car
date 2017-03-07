<?php

namespace App\Http\Controllers\WeChat;

use App\Http\Model\WeChat\We_chat_user_location;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    //用户进入会话是存储用户的地理位置
    public function saveLocation(Request $request){
        $OpenID=$request->input('OpenID');
        $content=$request->input('content');
        $id=We_chat_user_location::where('OpenID',$OpenID)->value('OpenID');
        if(empty($id)){
            $location=new We_chat_user_location;
            $location->OpenID=$OpenID;
            $location->location=$content;
            $location->save();
        }else{
            We_chat_user_location::where('OpenID',$OpenID)->update(['location'=>$content]);
        }
    }




    //查询用户地理位置，若不存在则用户拒绝了共享位置
    public function index(Request $request){
        $OpenID=$request->input('OpenID');
        $location=We_chat_user_location::where('OpenID',$OpenID)->value('location');
        if(!empty($location))
        {
            $attr=array('msg'=>urlencode($location));
            $json=json_encode($attr,true);
        }
        return $json;
    }

    //CURL
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

    //获取assess_token
    public function get_access_token(){
        $app_id="wxbbfbbbe89c83625b";
        $app_secret="fa684ef8617d8908ccff7ca778d51ebc";
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$app_id&secret=$app_secret";
        $json=http_request($url);
        $attr=json_decode($json,true);
        return $attr['access_token'];
    }

}
