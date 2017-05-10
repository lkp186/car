<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\We_chat_reimburse_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReimburseController extends Controller
{
    //油费报销界面
    public function index(){
        $reimburse=We_chat_reimburse_info::paginate(10);
        return view('admin.reimburse',['reimburse'=>$reimburse]);
    }
}
