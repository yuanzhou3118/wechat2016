<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\WecharUser
 *
 * @property integer $id
 * @property string $openid
 * @property string $nickname
 * @property integer $sex
 * @property string $city
 * @property string $province
 * @property string $headimgurl
 * @property string $subscribe_time
 * @property string $status_time
 * @property integer $subscribe
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $groupid
 * @method static \Illuminate\Database\Query\Builder|\App\WechatUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatUser whereOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatUser whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatUser whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatUser whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatUser whereProvince($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatUser whereHeadimgurl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatUser whereSubscribeTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatUser whereStatusTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatUser whereSubscribe($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatUser whereGroupid($value)
 */
class WechatUser extends Model
{
    protected $table = 'wechat_users';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['openid'];
}
