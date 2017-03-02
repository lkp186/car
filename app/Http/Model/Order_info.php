<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Order_info extends Model
{
    protected $table="order_info";
    protected $primaryKey="order_id";
    public $timestamps=false;
}
