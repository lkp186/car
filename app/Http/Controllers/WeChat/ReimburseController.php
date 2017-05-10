<?php

namespace App\Http\Controllers\WeChat;

use App\Http\Model\User_info;
use App\Http\Model\We_chat_reimburse_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ReimburseController extends Controller
{
    //油费报销界面
    public function index(Request $request){
        $OpenID=$request->input('OpenID');
        return view('weixin.reimburse_gas',['OpenID'=>$OpenID]);
    }
    //油费报销操作
    public function reimburseOpt(Request $request){
        $OpenID=$request->input('OpenID');
        $ID=User_info::where('OpenID',$OpenID)->value('user_ID_card');
        $user_name=User_info::where('OpenID',$OpenID)->value('user_name');
        $address=$request->input('address');
        $work_number=$request->input('work_number');
        $gas_invoice=$request->file('gas_invoice');//油费发票图片
        if ($gas_invoice->isValid()) {
            // 上传加油发票图片，获取文件相关信息
            $originalIDName = $gas_invoice->getClientOriginalName(); // 文件原名
            $ext = $gas_invoice->getClientOriginalExtension();     // 扩展名
            $realPath = $gas_invoice->getRealPath();   //临时文件的绝对路径
            $typeID = $gas_invoice->getClientMimeType();     // image/jpeg
            // 上传文件
            $filename_gas_invoice = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            // 使用我们新建的uploads本地存储空间（目录）
            $bool = Storage::disk('public')->put($filename_gas_invoice, file_get_contents($realPath));
            if($bool){
                $gauge_before=$request->file('gauge_before');//加油前的油表照片

                // 上传加油前油表图片，获取文件相关信息
                $originalIDName = $gauge_before->getClientOriginalName(); // 文件原名
                $ext = $gauge_before->getClientOriginalExtension();     // 扩展名
                $realPath = $gauge_before->getRealPath();   //临时文件的绝对路径
                $typeID = $gauge_before->getClientMimeType();     // image/jpeg
                // 上传文件
                $filename_gauge_before = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                $bool_gauge_before= Storage::disk('public')->put($filename_gauge_before, file_get_contents($realPath));
                if($bool_gauge_before){
                    $gauge_after=$request->file('gauge_after');//加油后的油表照片
                    // 上传加油前油表图片，获取文件相关信息
                    $originalIDName = $gauge_after->getClientOriginalName(); // 文件原名
                    $ext = $gauge_after->getClientOriginalExtension();     // 扩展名$realPath = $gas_invoice->getRealPath();   //临时文件的绝对路径
                    $typeID = $gauge_after->getClientMimeType();     // image/jpeg
                    // 上传文件
                    $filename_gauge_after = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                    // 使用我们新建的uploads本地存储空间（目录）
                    $bool_gauge_after= Storage::disk('public')->put($filename_gauge_after, file_get_contents($realPath));
                    if($bool_gauge_after){
                        $reimburse=new We_chat_reimburse_info;
                        $reimburse->user_name=$user_name;
                        $reimburse->user_ID=$ID;
                        $reimburse->gas_invoice_url='storage/app/public/'.$filename_gas_invoice;
                        $reimburse->gauge_before_url='storage/app/public/'.$filename_gauge_before;
                        $reimburse->gauge_after_url='storage/app/public/'.$filename_gauge_after;
                        $reimburse->address=$address;
                        $reimburse->work_number=$work_number;
                        $reimburse->save();
                        $status=1;
                        $message='上传成功';
                        return view('weixin.upload_message',['status'=>$status,'msg'=>$message]);
                    }
                }
            }
        }else{
            $status=0;
            $message='上传失败';
            return view('weixin.upload_message',['status'=>$status,'msg'=>$message]);
        }
    }
}
