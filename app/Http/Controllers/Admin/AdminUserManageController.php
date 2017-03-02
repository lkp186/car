<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Comment_info;
use App\Http\Model\User_info;
use App\Http\Model\User_status_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminUserManageController extends Controller
{
    //用户审核
    public function userCheck(Request $request){
        $choice=$request->input('choice');
        $request->session()->put('choice',$choice);
        if($choice==0){
            $result=User_status_info::where('user_status',0)->paginate(2);
            return view('admin.user_manage_check',['result'=>$result,'choice'=>$choice]);
        }elseif ($choice==1){
            $result=User_status_info::where('user_status',1)->paginate(2);
            return view('admin.user_manage_check',['result'=>$result,'choice'=>$choice]);
        }else{
            $result=User_status_info::where('user_status',2)->paginate(2);
            return view('admin.user_manage_check',['result'=>$result,'choice'=>$choice]);
        }

    }


    //更改用户的状态
    public function changeStatus(Request $request){
        $choice=$request->session()->get('choice');
        $user_drive_id=$request->input('user_drive_id');
        $status=$request->input('status');
        $request->session()->put('user_drive_id',$user_drive_id);
        $request->session()->put('status',$status);
        if($choice==0){
            User_status_info::where('user_drive_id',$user_drive_id)->update(['user_status'=>$status]);
            $result=User_status_info::where('user_status',0)->paginate(2);
            return view('admin.user_manage_check',['result'=>$result,'choice'=>$choice]);
        }elseif ($choice==1){
            User_status_info::where('user_drive_id',$user_drive_id)->update(['user_status'=>$status]);
            $result=User_status_info::where('user_status',1)->paginate(2);
            return view('admin.user_manage_check',['result'=>$result,'choice'=>$choice]);
        }else{
            User_status_info::where('user_drive_id',$user_drive_id)->update(['user_status'=>$status]);
            $result=User_status_info::where('user_status',2)->paginate(2);
            return view('admin.user_manage_check',['result'=>$result,'choice'=>$choice]);
        }
    }

    //删除用户界面
    public function deleteUser(){
        $result=User_info::paginate(3);
        return view('admin.user_manage_delete',['result'=>$result]);
    }

    //删除用户操作
    public function delete_user(Request $request){
        $email=$request->input('email');
        $request->session()->put('email',$email);
        $user_id=User_info::where('user_email',$email)->value('user_id');
        User_info::destroy($user_id);
        $result=User_info::paginate(3);
        return view('admin.user_manage_delete',['result'=>$result]);
    }

    //用户评论界面
    public function comment(){
        $result=Comment_info::paginate(8);
        return view('admin.user_comment',['result'=>$result]);
    }

    //删除用户评论
    public function delComment(Request $request){
        $id=$request->input('id');
        Comment_info::destroy($id);
        $result=Comment_info::paginate(8);
        return view('admin.user_comment',['result'=>$result]);
    }
}
