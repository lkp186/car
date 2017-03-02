<?php

namespace App\Http\Model;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Area_info extends Model
{
    protected $table="area_info";
    protected $primaryKey="area_id";
    public $timestamps=false;

    //查询所有汽车分布点的名称
    public static  function selectAllRoadName(){
        $areaNameRoad=Area_info::get();
        return $areaNameRoad;
    }

}
