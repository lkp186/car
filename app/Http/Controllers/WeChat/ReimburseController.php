<?php

namespace App\Http\Controllers\WeChat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReimburseController extends Controller
{
    //油费报销界面
    public function index(){
        return view('weixin.reimburse_gas');
    }
}
