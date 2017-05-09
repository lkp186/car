<?php

namespace App\Http\Controllers\WeChat;

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
        $gas_invoice=$request->file('gas_invoice');//油费发票图片
        $gauge_before=$request->file('gauge_before');//加油前的油表照片
        $gauge_after=$request->file('gauge_after');//加油后的油表照片
        $file=array($gas_invoice,$gauge_before,$gauge_after);
        // 文件是否上传成功
        if ($gas_invoice->isValid()&&$gauge_before->isValid()&&$gauge_after->isValid()) {
            $img=array();
            for($i=0;$i<=2;$i++){
                // 获取文件相关信息
                $originalName = $file[$i]->getClientOriginalName(); // 文件原名
                $ext = $file[$i]->getClientOriginalExtension();     // 扩展名
                $realPath = $file[$i]->getRealPath();   //临时文件的绝对路径
                $type = $file[$i]->getClientMimeType();     // image/jpeg

                // 上传文件
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                if($bool){
                    $img[$i]=$filename;
                }
            }
            dd($img);
        }else{
            return '上传失败';
        }
    }
}
