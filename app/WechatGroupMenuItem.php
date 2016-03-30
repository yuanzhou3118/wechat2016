<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatGroupMenuItem extends Model
{
    protected $table = 'wechat_group_menu_items';

    protected $fillable = ['id','name','type','url','key','sort_num','is_button','button_id','media_id','created_at','updated_at'];
}
