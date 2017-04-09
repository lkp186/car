<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Comment_info;
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
        $result=Order_info::where(['order_name_ID'=>$ID])->get();
        return view('home.comment',['result'=>$result]);
    }
    //用户输入评论界面
    public function comment(Request $request){
        $order_number=$request->input('order_number');
        $comment=Order_info::where('order_number',$order_number)->get();
        return view('home.user_comment',['comment'=>$comment,'order_number'=>$order_number]);
    }
    //用户进行评论的行为的处理
    public function commentOpt(Request $request){
        $user_id=$request->session()->get('user_id');
        $content=$request->input('content');
        $order_number=$request->input('order_number');
        $comment_name=Comment_info::where('order_number',$order_number)->value('comment_name');
        if(empty($comment_name)){
            Order_info::where('order_number',$order_number)->update(['order_comment_status'=>1]);
            $comment=new Comment_info;
            $comment->order_number=$order_number;
            $comment->comment_content=$content;
            $comment->comment_name=$request->session()->get('username');
            date_default_timezone_set('PRC');
            $comment->comment_time=time();
            $comment->user_id=$user_id;
            $comment->save();
        }
        $ID=User_info::where('user_id',$user_id)->value('user_ID_card'); //获取身份证编号
        $result=Order_info::where('order_name_ID',$ID)->get();
        return view('home.comment',['result'=>$result]);
    }
}
