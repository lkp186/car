<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class City_info extends Model
{
    protected $table="city_info";
    protected $primaryKey="city_id";
    public $timestamps=false;



    //查询该城市的所有辖区
    public static function selectCityAreaName(){
        $areaName=City_info::where('city_name','连云港')->get();
        return $areaName;
    }
}
