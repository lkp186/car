<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Get_car_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GetCarController extends Controller
{
    public function index(){
        return view('home.get_car');
    }
    //取车
    public function getCar(Request $request){
        $code=$request->input('code');
        $user_ID=Get_car_info::where('getCar_code',$code)->value('user_ID');
        if(empty($user_ID)){
            return 0;
        }else{
            return 1;
        }
    }
}
