<?php

namespace App\Http\Controllers\WeChat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReimburseController extends Controller
{
    //油费报销界面
    public function index(Request $request){
        $OpenID=$request->input('OpenID');
        return view('weixin.reimburse_gas',['OpenID'=>$OpenID]);
    }
    //油费报销操作
    public function reimburseOpt(Request $request){
        $OpenID=$request->input('OpenID');
        $gas_invoice=$request->file('gas_invoice');//油费发票图片
        $gauge_before=$request->file('gauge_before');//加油前的油表照片
        $gauge_after=$request->file('gauge_after');//加油后的油表照片
    }
}
