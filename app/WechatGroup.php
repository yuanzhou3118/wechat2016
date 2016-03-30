<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\WechatGroup
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $name
 * @property integer $count
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\WechatGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatGroup whereGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatGroup whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatGroup whereCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatGroup whereUpdatedAt($value)
 */
class WechatGroup extends Model
{
    protected $table = 'wechat_groups';

    protected $fillable = ['name', 'count','group_id'];
}
