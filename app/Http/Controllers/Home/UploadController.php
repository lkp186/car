<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\User_status_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    //上传身份证和驾驶证
    public function index(Request $request){
        $true_name=$request->input('true_name');
        $drive_number=$request->input('drive_number');
        $file=$request->file('ID_card');
        if($file->isValid()){
            // 获取文件相关信息
            $originalIDName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $typeID = $file->getClientMimeType();     // image/jpeg
            // 上传文件
            $filename_id_card = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            // 使用我们新建的uploads本地存储空间（目录）
            $bool = Storage::disk('public')->put($filename_id_card, file_get_contents($realPath));
            if($bool){
                //上传驾驶证
                $file=$request->file('drive_card');
                if($file->isValid()){
                    // 获取文件相关信息
                    $originalDriveName = $file->getClientOriginalName(); // 文件原名
                    $ext = $file->getClientOriginalExtension();     // 扩展名
                    $realPath = $file->getRealPath();   //临时文件的绝对路径
                    $typeDrive = $file->getClientMimeType();     // image/jpeg
                    // 上传文件
                    $filename_drive = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                    // 使用我们新建的uploads本地存储空间（目录）
                    $bool = Storage::disk('public')->put($filename_drive, file_get_contents($realPath));
                    if($bool){
                        $user=new User_status_info;
                        $user_id=$request->session()->get('user_id');
                        $user_name=User_status_info::where('user_id',$user_id)->value('user_name');
                        if(empty($user_name)){
                            //向用户状态表中插入一条数据
                            $user->user_id=$user_id;
                            $user->user_name=$true_name;
                            $user->user_drive_id=$drive_number;
                            $user->id_image=$filename_id_card;
                            $user->drive_image=$filename_drive;
                            $user->save();
                            $result=User_status_info::find($user_id);
                            return view('home.personal_manage_status',['result'=>$result->toArray()]);
                        }else{
                            $result=User_status_info::find($user_id);
                            return view('home.personal_manage_status',['result'=>$result->toArray()]);
                        }
                     }else{
                        return '文件上传失败';
                    }
                }
            }
        }
    }
}
