<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Comment_info;
use App\Http\Model\Image_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //网站首页
    public function index(){
        $result=Image_info::where('image_category',1)->get();
        $image=Image_info::where('image_category',0)->get();
        $comment=Comment_info::orderBy('comment_time', 'desc')->limit(7)->get();
        return view('home.home',['result'=>$result,'image'=>$image,'comment'=>$comment]);
    }
    //订车须知
    public function notice(){
        return view('home.notice');
    }
}
