<?php

namespace App\Http\Controllers\WeChat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NetStationController extends Controller
{
    //网点分布
    public function netStation(){
        return view('weixin.netStation');
    }
}
