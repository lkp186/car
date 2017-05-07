<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MarginController extends Controller
{
    //缴纳保证金界面
    public function index(Request $request){
        return view('home.margin');
    }
}
