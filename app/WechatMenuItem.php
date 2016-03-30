<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\WechatMenuItem
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $url
 * @property string $key
 * @property integer $sort_num
 * @property boolean $is_button
 * @property integer $button_id
 * @property string $media_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\WechatMenuItem whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatMenuItem whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatMenuItem whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatMenuItem whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatMenuItem whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatMenuItem whereSortNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatMenuItem whereIsButton($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatMenuItem whereButtonId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatMenuItem whereMediaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatMenuItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatMenuItem whereUpdatedAt($value)
 */
class WechatMenuItem extends Model
{
    protected $table = 'wechat_menu_items';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
