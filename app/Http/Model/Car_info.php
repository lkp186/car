<?php

namespace App\Http\Model;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;

class Car_info extends Model
{
    protected $table="car_info";
    protected $primaryKey="car_id";
    public $timestamps=false;

    //查询可用的汽车，并且分页
    public static function queryCar(){
        $car=Car_info::where('car_status',1)->paginate(8);
        return $car;
    }
}
