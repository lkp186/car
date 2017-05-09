<?php

namespace App\Http\Controllers\WeChat;

use App\Http\Model\Order_info;
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
    //绑定微信账号信息
    public function binding(){
        return view('weixin.bind');
    }
}
