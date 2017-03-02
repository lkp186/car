<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class AdminLoginController extends Controller
{
    //管理员登录界面
    public function index(){
        return view('admin.admin_login');
    }

    //生成验证码
    public function code(Request $request){
        $code=new \Code();
        $code->make();
        $code->get();
    }

    //判断验证码是否正确
    public function checkCode(Request $request){
        $code=$request->input('code');
        if(strtoupper($code)==strtoupper($_SESSION['code'])){
            return 1;
        }else{
            return 0;
        }
    }
    //异步登录验证
    public function checkLogin(Request $request){
        $number=$request->input('number');
        $password=$request->input('password');
        $admin_password=Admin_info::where(['admin_email'=>$number])->value('admin_password');
        if(!empty($admin_password)){
            if($password==Crypt::decrypt($admin_password)){
                $request->session()->put('adminName',$number);
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }

    }
    public function logout(Request $request){
        $request->session()->forget('choice');
        $request->session()->forget('user_drive_id');
        $request->session()->forget('adminName');
        $request->session()->forget('status');
        return view('admin.admin_login');
    }

}
