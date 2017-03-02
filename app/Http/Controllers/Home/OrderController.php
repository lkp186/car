<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Area_info;
use App\Http\Model\Car_info;
use App\Http\Model\City_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //显示所有地区的所有可用汽车
    public function index(Request $request){
        $areaName=City_info::selectCityAreaName();
        $areaNameRoad=Area_info::selectAllRoadName();
       $car=Car_info::queryCar();
        $request->session()->forget('city_id');
        $request->session()->forget('area_name_road');
        return view('home.order',
            [
                'areaName'=>$areaName,
                'areaNameRoad'=>$areaNameRoad,
                'allCar'=>$car,
                'class'=>'label label-primary'
            ]
        );
    }

    //显示当前辖区下的所有可用汽车
    public function areaAllCar(Request $request){
        $request->session()->put('city_id',$request->input('city_id'));
        $areaName=City_info::selectCityAreaName();


        //根据city_id来查找相应辖区下的分布点名称
        $areaNameRoad=Area_info::where('area_pid',$request->session()->get('city_id'))->get();


        //查询当前辖区下的所有可用的汽车
        $car=Car_info::where(['car_status'=>1,'car_pid_pid'=>$request->session()->get('city_id')])->paginate(8);
        return view('home.order',
            [
                'areaName'=>$areaName,
                'areaNameRoad'=>$areaNameRoad,
                'allCar'=>$car
            ]
        );
    }
    //显示当前街道下的所有可用的汽车
    public function areaRoadAllCar(Request $request){
        //获取当前街道所属辖区的id
        $area_pid=Area_info::where('area_name_road',$request->input('area_name_road'))->value('area_pid');
        $request->session()->put('city_id',$area_pid);
        $request->session()->put('area_name_road',$request->input('area_name_road'));
        $areaName=City_info::selectCityAreaName();

        //根据city_id来查找相应辖区下的分布点名称
        $areaNameRoad=Area_info::where('area_pid',$area_pid)->get();
        $area_id=Area_info::where('area_name_road',$request->session()->get('area_name_road'))->value('area_id');
        $car=Car_info::where(['car_pid'=>$area_id,'car_status'=>1])->paginate(8);
        return view('home.order',
            [
                'areaName'=>$areaName,
                'areaNameRoad'=>$areaNameRoad,
                'allCar'=>$car
            ]
        );
    }

}
