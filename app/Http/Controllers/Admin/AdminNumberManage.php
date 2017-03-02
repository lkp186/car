<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class AdminNumberManage extends Controller
{
    //用户修改密码界面
    public function index(){
        return view('admin.change_pwd');
    }

    //验证原密码是否正确
    public function checkOrgPwd(Request $request){
        $password=$request->input('originalPassword');
        $admin_password=Admin_info::where('admin_email',$request->session()->get('adminName'))->value('admin_password');
        if(Crypt::decrypt($admin_password)==$password){
            return 1;
        }else{
            return 0;
        }
    }

    //修改密码
    public function changePassword(Request $request){
        $password=Crypt::encrypt($request->input('newPassword'));
        Admin_info::where('admin_email',$request->session()->get('adminName'))->update(['admin_password'=>$password]);
        return view('admin.change_pwd',['msg'=>'修改成功,请重新登陆!!',]);
    }
}
