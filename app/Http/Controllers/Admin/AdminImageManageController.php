<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Image_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminImageManageController extends Controller
{
    //首页轮播图片
    public function index(){
        $result=Image_info::where('image_category',0)->get();
        return view('admin.image_manage',['result'=>$result]);
    }

    //更改轮播图片
    public function changeImage(Request $request){
        $originalPath=$request->input('path');
        $file=$request->file('image');
        if($file->isValid()){
            // 获取文件相关信息
            $originalIDName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $typeID = $file->getClientMimeType();     // image/jpeg
            // 上传文件
            $filename_id_card = 'home-' . uniqid() . '.' . $ext;
            // 使用我们新建的uploads本地存储空间（目录）
            $bool=Storage::disk('img')->put($filename_id_card, file_get_contents($realPath));
            if($bool){
                Image_info::where('image_path',$originalPath)->update(['image_path'=>'storage/public/img/'.$filename_id_card]);
                $result=Image_info::where('image_category',0)->get();
                return view('admin.image_manage',['result'=>$result]);
            }else{
                echo'上传失败';
            }
        }
    }
}
