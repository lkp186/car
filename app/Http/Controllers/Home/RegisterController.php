<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Comment_info;
use App\Http\Model\Image_info;
use App\Http\Model\User_info;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;


class RegisterController extends Controller
{
    public function registerPage(){
        return view('home.register');
    }

    //ajax验证邮箱2017.1.10
    public function checkEmail(Request $request){
        $input=$request->all();
        $result=User_info::where('user_email',$input['email'])->value('user_email');
        if(empty($result)){
            return '1';
        }else{
            return '0';
        }
    }

    //ajax验证身份证号2017.1.10
    public function checkID(Request $request){
        $input=$request->all();
        $result=User_info::where('user_ID_card',$input['ID'])->value('user_ID_card');
        if(empty($result)){
            return '1';
        }else{
            return '0';
        }
    }

    //发送验证邮件2017.1.10
    public function sendEmail(Request $request){
        $email=$request->input('email');
        $code=rand(100,999).rand(100,999);//随机产生验证码
        $request->session()->put('code',$code);//向session中存储验证码
        $flag = Mail::send('emails.sendmail',['name'=>$email,'code'=>$code],function($message)use($email,$code){
            $to = $email;
            $message ->to($to)->subject('注册码');
        });
        if($flag){
            return '发送邮件成功，请查收！';
        }else{
            return '发送邮件失败，请重试！';
        }
    }

    //用户注册时验证注册码是否正确
    public function checkCode(Request $request){
        $input=$request->all();
        if($input['code']!=$request->session()->get('code')){
           return 0;
        }else{
            return 1;
        }
    }

    //用户注册
    public function register(Request $request){
        $input=$request->all();
        $user=new User_info;
        $user->user_email=$input['email'];
        $user->user_password=Crypt::encrypt($input['password']);
        $user->user_name=$input['username'];
        $user->user_ID_card=$input['ID'];
        $user->save();
        $request->session()->put('username',$input['username']);
        $result=Image_info::where('image_category',1)->get();
        $image=Image_info::where('image_category',0)->get();
        $comment=Comment_info::get();
        return view('home.home',['result'=>$result,'image'=>$image,'comment'=>$comment]);
    }
}
