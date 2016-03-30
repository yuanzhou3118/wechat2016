<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatMenu extends Model
{
    protected  $table = 'wechat_menus';

    protected $fillable = ['menu_info'];
}
