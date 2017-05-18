<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Order_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchOrderController extends Controller
{
    public function index(){
        return view('home.search');
    }

    //订单查找
    public function search(Request $request){
        $ID=$request->input('ID');
        $record=Order_info::where('order_name_ID',$ID)->orderBy('order_time', 'desc')->get();
        return view('home.search_result',['record'=>$record]);
    }
}
