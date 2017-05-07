<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Margin_info;
use App\Http\Model\Order_info;
use App\Http\Model\User_info;
use App\Http\Model\User_status_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PersonalController extends Controller
{
    //个人信息界面
    public function index(Request $request){
        $user_id=$request->session()->get('user_id');
        $ID=User_info::where('user_id',$user_id)->value('user_ID_card'); //获取身份证编号
        $order=Order_info::where('order_name_ID',$ID)->orderBy('order_time','desc')->limit(1)->get();
        //查询用户是否进行了资格审查
        $user_id=$request->session()->get('user_id');
        $user_status=User_status_info::where('user_id',$user_id)->value('user_status');
        if(empty($user_status)){
            $user_status='未';
        }else{
            $user_status='已';
        }

        //查询用户是否缴纳了保证金
        $margin_status=Margin_info::where('margin_ID_card',$ID)->value('margin_status');
        if(empty($margin_status)){
            $margin_status='否';
        }else{
            $margin_status='是';
        }

        return view('home.personal_info',
            [
                'order'=>$order,
                'ID'=>$ID,
                'margin_status'=>$margin_status,
                'user_status'=>$user_status
            ]
        );
    }

    public function personalManage(Request $request){
        $user_id=$request->session()->get('user_id');
        $user_name=User_status_info::where('user_id',$user_id)->value('user_name');
        if(empty($user_name)){
            return view('home.personal_manage');
        }
        else{
            $result=User_status_info::find($user_id);

            return view('home.personal_manage_status',['result'=>$result->toArray()]);
        }

    }
    //用户守则界面
    public function rules(){
        return view('home.user_rules');
    }

}
