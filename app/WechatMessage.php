<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatMessage extends Model
{
    protected $table = "wechat_messages";

    protected $fillable = ['messages_id','type','messages','guid','open_id','account_id','create_time'];
}
