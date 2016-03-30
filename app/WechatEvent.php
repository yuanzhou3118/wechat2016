<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\WechatEvent
 *
 * @property integer $id
 * @property string $key
 * @property boolean $is_menu
 * @property string $type
 * @property string $text
 * @property string $title
 * @property string $description
 * @property string $url
 * @property string $image
 * @property string $media_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\WechatEvent whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatEvent whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatEvent whereIsMenu($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatEvent whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatEvent whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatEvent whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatEvent whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatEvent whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatEvent whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatEvent whereMediaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatEvent whereUpdatedAt($value)
 */
class WechatEvent extends Model
{
    protected $table = 'wechat_events';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
