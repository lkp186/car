<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Comment_info;
use App\Http\Model\Image_info;
use App\Http\Model\User_info;
use Illuminate\Http\Request;
require_once 'resources/org/code/Code.class.php';
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    public function login(){
        return view('home.login');
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
    // 验证用户的账户信息是否正确
    public function loginCheck(Request $request){
        $input=$request->except('_token');
        $password=User_info::where('user_email',$input['email'])->value('user_password');
        if(!empty($password)){
            if(Crypt::decrypt($password)==$input['password']){
                $username=User_info::where('user_email',$input['email'])->value('user_name');
                $user_id=User_info::where('user_email',$input['email'])->value('user_id');
                $request->session()->put('username',$username);
                $request->session()->put('user_id',$user_id);
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
    //退出
    public function logout(Request $request){
        $result=Image_info::where('image_category',1)->get();
        $image=Image_info::where('image_category',0)->get();
        $comment=Comment_info::get();
        $request->session()->forget('username');
        return view('home.home',['result'=>$result,'image'=>$image,'comment'=>$comment]);
    }
}
