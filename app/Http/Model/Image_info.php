<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Image_info extends Model
{
    protected $table="image_info";
    protected $primaryKey="image_id";
    public $timestamps=false;

    //把关于汽车价格的图片遍历出来
    public static function query(){
        $result=Image_info::get();
        return $result;
    }
}
