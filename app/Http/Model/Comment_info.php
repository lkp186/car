<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Comment_info extends Model
{
    protected $table="comment_info";
    protected $primaryKey="comment_id";
    public $timestamps=false;
}
