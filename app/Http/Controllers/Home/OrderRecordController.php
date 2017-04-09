<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Order_info;
use App\Http\Model\User_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderRecordController extends Controller
{
    //个人中心-消费记录
    public function payRecord(Request $request){
        $user_id=$request->session()->get('user_id');
        $ID=User_info::where('user_id',$user_id)->value('user_ID_card'); //获取身份证编号
        $result=Order_info::where('order_name_ID',$ID)->get();
        return view('home.personal_pay_record',['record'=>$result]);
    }
    public function homeRecord(Request $request){
        $user_id=$request->session()->get('user_id');
        $ID=User_info::where('user_id',$user_id)->value('user_ID_card'); //获取身份证编号
        $order=Order_info::where('order_name_ID',$ID)->paginate(3);
        return view('home.home_pay_record',['order'=>$order]);
    }
}
