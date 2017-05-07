<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Area_info;
use App\Http\Model\Car_info;
use App\Http\Model\City_info;
use App\Http\Model\Comment_info;
use App\Http\Model\Get_car_info;
use App\Http\Model\Image_info;
use App\Http\Model\Margin_info;
use App\Http\Model\Order_info;
use App\Http\Model\User_info;
use App\Http\Model\User_status_info;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PayController extends Controller
{
    //支付界面主页
    public function index(Request $request){
        $id=$request->session()->get('user_id');
        $status=User_status_info::where('user_id',$id)->value('user_status');
        $ID=User_info::where('user_id',$id)->value('user_ID_card');
        //判断用户是否缴纳了保证金,保证金低于500元无法预约
        $margin_status=Margin_info::where('margin_ID_card',$ID)->value('margin_status');

        $margin_balance=Margin_info::where('margin_ID_card',$ID)->value('margin_balance');
        if(empty($margin_status)){
            return view('home.margin_403');
        }else if ($margin_balance<='500'){
            return '保证金低于500元，请重新缴纳3000元保证金';
        }
        //判断用户是否已经通过审核，只有审核后才能下单，否则报403
        if($status==1){
            $input=$request->all();
            $car_pid=$input['car_pid'];
            $area_name_road=Area_info::where('area_id',$car_pid)->value('area_name_road');
            return view('home.pay',
                [   'car_category'=>$input['car_category'],
                    'car_number'=>$input['car_number'],
                    'car_day_price'=>$input['car_day_price'],
                    'car_hour_price'=>$input['car_hour_price'],
                    'car_img'=>$input['car_img'],
                    'area_name_road'=>$area_name_road
                ]);
        }else{
            return view('home.403');
        }
    }

    //计算应该支付的金额
    public function countPay(Request $request){
        if(!empty($request->input('timeByHour'))){
            $hourPrice=$request->input('hourPrice');
            return $request->input('timeByHour')*$hourPrice;
        }else{
            $dayPrice=$request->input('dayPrice');
            return $request->input('timeByDay')*$dayPrice;
        }
    }
    //支付请求处理
    public function handle(Request $request){
        $input=$request->all();
        if(!empty($input)){
            $image=$input['image'];
            $user_id=$input['user_id'];
            $car_number=$input['car_number'];
            $order_number=$input['order_number'];
            $car_category=$input['car_category'];
            $location=$input['location'];
            $money=$input['money'];
            $ID=User_info::where('user_id',$user_id)->value('user_ID_card'); //获取身份证编号
            //判断用户是否下过订单
            $user_name=Order_info::where('order_name_ID',$ID)->value('user_name');
            if(!empty($user_name)){
                return 2;
            }

            $order=new Order_info;
            //往订单表里面插入数据
            $order->car_image=$image;
            $order->order_number=$order_number;
            $order->car_category=$car_category;
            $order->user_name=$request->session()->get('username');
            $order->order_money=$money.'元';
            $order->car_number=$car_number;
            date_default_timezone_set('PRC'); //设置中国时区
            $order->order_time=time();
            $order->order_name_ID=$ID;
            $order->car_location=$location;
            $order->save();
            //修改车的状态，改成已经被租用
            Car_info::where('car_number',$car_number)->update(['car_status'=>0]);
            $get_car_code=$car_number.rand(100,999); //取车码
            $return_car_code=$car_number.rand(100,999);//还车码
            //将取车信息存入到待取车表中
            $getCar=new Get_car_info;
            $getCar->car_number=$car_number;
            $getCar->order_time=time();
            $getCar->getCar_code=$get_car_code;
            $getCar->returnCar_code=$return_car_code;
            $getCar->save();
            return 1;
        }else{
            return 0;
        }
    }
}
