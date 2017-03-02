<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Order_info;
use App\Http\Model\User_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //用户评论界面
    public function commentView(Request $request){
        $user_id=$request->session()->get('user_id');
        $ID=User_info::where('user_id',$user_id)->value('user_ID_card'); //获取身份证编号
        $result=Order_info::where('order_name_ID',$ID)->get();
        return view('home.comment',['result'=>$result]);
    }
}
