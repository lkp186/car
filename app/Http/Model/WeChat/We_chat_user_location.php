<?php

namespace App\Http\Model\WeChat;

use Illuminate\Database\Eloquent\Model;

class We_chat_user_location extends Model
{
    protected $table="we_chat_user_location";
    protected $primaryKey="OpenID";
    public $timestamps=false;
}
