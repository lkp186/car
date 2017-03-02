<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User_status_info extends Model
{
    protected $table="user_status_info";
    protected $primaryKey="user_id";
    public $timestamps=false;
}
