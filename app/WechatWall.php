<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatWall extends Model
{
    protected $table = 'wechat_walls';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $hidden = ['theme', 'keyword', 'title', 'logo', 'tdcode', 'bg_img'];
}
