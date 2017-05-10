<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Margin_info;
use App\Http\Model\User_info;
use App\Http\Model\We_chat_reimburse_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ReimburseController extends Controller
{
    //油费报销界面
    public function index(){
        $reimburse=We_chat_reimburse_info::paginate(10);
        return view('admin.reimburse',['reimburse'=>$reimburse]);
    }
    //油费同意报销界面
    public function agreeView(Request $request){
        $ID=$request->input('ID');
        $user_name=User_info::where('user_ID_card',$ID)->value('user_name');
        $user_email=User_info::where('user_ID_card',$ID)->value('user_email');
        return view('admin.reimburse_agree',['ID'=>$ID,'user_name'=>$user_name,'user_email'=>$user_email]);
    }
    //油费同意报销操作
    public function agree(Request $request){
        $ID=$request->input('ID');
        $money=$request->input('money');
        $margin_balance=Margin_info::where('margin_ID_card',$ID)->value('margin_balance');
        $newBalance=$margin_balance+$money;
        //将油费打入用户的保证金账户
        Margin_info::where('margin_ID_card',$ID)->update(['margin_balance'=>$newBalance]);
        //发送邮件通知用户
        $email=$request->input('email');
        $flag = Mail::send('emails.reimbursement',['name'=>$email,'money'=>$money],function($message)use($email){
            $to = $email;
            $message ->to($to)->subject('报销通知');
        });
        if($flag){
            return 1;
        }else{
            return 0;
        }

    }
}
