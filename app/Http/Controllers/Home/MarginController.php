<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Margin_info;
use App\Http\Model\User_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MarginController extends Controller
{
    //缴纳保证金界面
    public function index(Request $request){
        $ID=$request->input('ID');
        return view('home.margin',['ID'=>$ID]);
    }
    //缴纳保证金的操作
    public function payMargin(Request $request){
        $ID=$request->input('ID');
        //根据用户的身份证号查出用户的姓名
        $user_name=User_info::where('user_ID_card',$ID)->value('user_name');
        $margin_name=Margin_info::where('margin_ID_card',$ID)->value('margin_name');
        if(empty($margin_name)){
            $margin=new Margin_info;
            $margin->margin_name=$user_name;
            $margin->margin_ID_card=$ID;
            $margin->margin_status='1';
            $margin->margin_number='3000';
            $margin->margin_balance='3000';
            $margin->save();
        }else{
            //保证金充值
            $margin_balance=Margin_info::where('margin_ID_card',$ID)->value('margin_balance');
            Margin_info::where('margin_ID_card',$ID)->update(['margin_balance'=>$margin_balance+3000]);
        }
        return $ID;
    }
}
