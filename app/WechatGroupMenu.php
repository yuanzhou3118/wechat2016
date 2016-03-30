<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\WechatGroupMenu
 *
 * @property integer $id
 * @property string $menuid
 * @property string $group_id
 * @property string $sex
 * @property string $client_platform_type
 * @property string $country
 * @property string $province
 * @property string $city
 * @property string $language
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */

class WechatGroupMenu extends Model
{
    protected $table = 'wechat_group_menus';

    protected $fillable = ['id','menuid','group_id','sex','client_platform_type','country','province','city','language','created_at','updated_at'];
}
