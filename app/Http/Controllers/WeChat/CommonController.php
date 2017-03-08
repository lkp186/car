<?php

namespace App\Http\Controllers\WeChat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    //新人指引页面
    public function help(){
        return view('weixin.help');
    }
    public function searchOrder(){
        return view('weixin.search');
    }
}
