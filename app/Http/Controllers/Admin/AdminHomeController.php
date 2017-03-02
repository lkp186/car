<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminHomeController extends Controller
{
    //管理员主界面
    public function index(){
        return view('admin.home');
    }
}
