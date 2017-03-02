<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Area_info;
use App\Http\Model\Car_info;
use App\Http\Model\City_info;
use App\Http\Model\Image_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NetPointManageController extends Controller
{
    //网点车辆分布管理
    public function index(Request $request){
        $request->session()->forget('road');
        $request->session()->forget('area');
        $area=Area_info::get();
        $car=Car_info::where('car_pid_pid',1)->paginate(10);
        return view('admin.net_point_car',['area'=>$area,'car'=>$car]);
    }

    //删除相应网点下的车辆
    public function deleteCar(Request $request){
        $id=$request->input('id');
        Car_info::destroy($id);
        $inputArea=$request->session()->get('area');
        $inputRoad=$request->session()->get('road');
        if($inputRoad=='全部'){
            $area=Area_info::get();
            $area_id=City_info::where('city_area_name',$inputArea)->value('city_id');
            $car=Car_info::where('car_pid_pid',$area_id)->paginate(10);
            return view('admin.net_point_car',['area'=>$area,'car'=>$car]);
        }
        $area=Area_info::get();
        $car=Car_info::paginate(10);
        $area_id=Area_info::where(['area_name'=>$inputArea,'area_name_road'=>$inputRoad])->value('area_id');
        $area_sub=Area_info::where(['area_name'=>$request->session()->get('area'),'area_name_road'=>$request->session()->get('road')])->get();
        $car_sub=Car_info::where('car_pid',$area_id)->paginate(10);
        return view('admin.net_point_car',['area'=>$area,'car'=>$car,'area_sub'=>$area_sub,'car_sub'=>$car_sub]);
    }

    //根据条件查找车辆
    public static function queryCar(Request $request){
        $inputArea=$request->input('area');
        $inputRoad=$request->input('road');
        $request->session()->put('area',$inputArea);
        $request->session()->put('road',$inputRoad);
        if($inputRoad=='全部'){
            $area=Area_info::get();
            $area_id=City_info::where('city_area_name',$inputArea)->value('city_id');
            $car=Car_info::where('car_pid_pid',$area_id)->paginate(10);
            return view('admin.net_point_car',['area'=>$area,'car'=>$car]);
        }
        $area=Area_info::get();
        $car=Car_info::paginate(10);
        $area_id=Area_info::where(['area_name'=>$inputArea,'area_name_road'=>$inputRoad])->value('area_id');
        $area_sub=Area_info::where(['area_name'=>$request->session()->get('area'),'area_name_road'=>$request->session()->get('road')])->get();
        $car_sub=Car_info::where('car_pid',$area_id)->paginate(10);
        return view('admin.net_point_car',['area'=>$area,'car'=>$car,'area_sub'=>$area_sub,'car_sub'=>$car_sub]);
    }

    //在相应的网点下添加车辆
    public function addCar(Request $request){
        $input=$request->all();
        $request->session()->put('area',$input['area']);
        $request->session()->put('road',$input['road']);
        $request->session()->put('category',$input['category']);
        $request->session()->put('number',$input['number']);
        $request->session()->put('hour',$input['hour']);
        $request->session()->put('day',$input['day']);
        $area_id=Area_info::where(['area_name'=>$request->session()->get('area'),'area_name_road'=>$request->session()->get('road')])->value('area_id');
        $city_id=City_info::where('city_area_name',$request->session()->get('area'))->value('city_id');
        $img_path=Image_info::where('image_name',$request->session()->get('category'))->value('image_path');
        //插入数据
        $car=new Car_info;
        $car->car_number=$request->session()->get('number');
        $car->car_img=$img_path;
        $car->car_category=$request->session()->get('category');
        $car->car_hour_price=$request->session()->get('hour');
        $car->car_day_price=$request->session()->get('day');
        $car->car_pid=$area_id;
        $car->car_status=1;
        $car->car_pid_pid=$city_id;
        $car->save();

        //将结果处理后再返回到上一个页面
        $inputArea=$request->session()->get('area');
        $inputRoad=$request->session()->get('road');
        if($inputRoad=='全部'){
            $area=Area_info::get();
            $area_id=City_info::where('city_area_name',$inputArea)->value('city_id');
            $car=Car_info::where('car_pid_pid',$area_id)->paginate(10);
            return view('admin.net_point_car',['area'=>$area,'car'=>$car]);
        }
        $area=Area_info::get();
        $car=Car_info::paginate(10);
        $area_id=Area_info::where(['area_name'=>$inputArea,'area_name_road'=>$inputRoad])->value('area_id');
        $area_sub=Area_info::where(['area_name'=>$request->session()->get('area'),'area_name_road'=>$request->session()->get('road')])->get();
        $car_sub=Car_info::where('car_pid',$area_id)->paginate(10);
        return view('admin.net_point_car',['area'=>$area,'car'=>$car,'area_sub'=>$area_sub,'car_sub'=>$car_sub]);
    }


    //网点分布界面
    public function netPoint(){
        $area=Area_info::orderBy('area_name', 'desc')->paginate(8);
        return view('admin.netPoint',['area'=>$area]);
    }
    //添加网点
    public function addNetPoint(Request $request){
        $input=$request->all();
        if(empty($input['area'])){
            $area=Area_info::paginate(8);
            return view('admin.netPoint',['area'=>$area]);
        }
        $city_id=City_info::where('city_area_name',$input['area'])->value('city_id');
        $area=new Area_info;
        $area->city_name='连云港';
        $area->area_name=$input['area'];
        $area->area_name_road=$input['road'];
        $area->area_pid=$city_id;
        $area->save();
        $area=Area_info::paginate(8);
        return view('admin.netPoint',['area'=>$area]);
    }

    //删除网点,同时也会删除该网点下的所有车
    public function delNetPoint(Request $request){
        Area_info::destroy($request->input('id'));
        $area=Area_info::paginate(8);
        Car_info::where('car_pid',$request->input('id'))->delete();
        return view('admin.netPoint',['area'=>$area]);
    }
}
