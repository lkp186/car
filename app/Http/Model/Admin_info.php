<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Admin_info extends Model
{
    protected $table="admin_info";
    protected $primaryKey="admin_id";
    public $timestamps=false;
}
