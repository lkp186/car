<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Car_info;
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
            $getCarTime=Get_car_info::where('getCar_code',$code)->value('getCarTime');
            if(empty($getCarTime)){
                Get_car_info::where('getCar_code',$code)->update(['getCarTime'=>time()]);
                return 1;
            }else{
                return 2;//表示用户已经取过车了
            }

        }
    }

    //还车
    public function returnCar(Request $request){
        $code=$request->input('code');
        $getCarTime=Get_car_info::where('returnCar_code',$code)->value('getCarTime');
        if($getCarTime!=0){
            $car_number=Get_car_info::where('returnCar_code',$code)->value('car_number');
            //将车辆的状态从被租用改成可以使用的状态
            Car_info::where('car_number',$car_number)->update(['car_status'=>1]);

            //将待取车辆表中相应车辆的信息删除
            $getCar_id=Get_car_info::where('car_number',$car_number)->value('getCar_id');
            Get_car_info::destroy($getCar_id);
//            //用户实际用车时间
//            $userCarTime=time()-$getCarTime;
//            //用户预订用车时间
//            $use_time=Car_info::where('car_number',$car_number)->value('use_time');
//            $difference=$userCarTime-$use_time;
            return 1;//表示用户还车成功

        }else{
            return 0;//表示用的用户的还车码不正确
        }
    }

}
