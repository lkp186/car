<?php

namespace App\Http\Controllers\WeChat;

use App\Http\Model\Order_info;
use App\Http\Model\User_info;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    //新人指引页面
    public function help(){
        return view('weixin.help');
    }
    //查询界面
    public function searchOrder(){
        return view('weixin.search');
    }
    //查询结果界面
    public function searchResult(Request $request){
        $ID=$request->input('ID');
        $record=Order_info::where('order_name_ID',$ID)->get();
        return view('weixin.search_order',['record'=>$record]);
    }
    //绑定微信账号信息界面
    public function binding(Request $request){
        $OpenID=$request->input('OpenID');
        return view('weixin.bind',['OpenID'=>$OpenID]);
    }
    //绑定微信账号信息的操作
    public function bindOpt(Request $request){
        $email=$request->input('email');
        $ID=$request->input('ID');
        $OpenID=$request->input('OpenID');
        $user_name=User_info::where(['user_email'=>$email,'user_ID_card'=>$ID])->value('user_name');
        if(empty($user_name)){
            $msg='绑定失败';
            return view('bind_message',['msg'=>$msg]);
        }else{
            //将用户的微信与网站账号绑定起来
            User_info::where('user_ID_card',$ID)->update(['OpenID'=>$OpenID]);
            $msg='绑定成功';
            return view('bind_message',['msg'=>$msg]);
        }
    }
}
