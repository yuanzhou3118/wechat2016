<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\WechatBinding
 *
 * @property integer $id
 * @property integer $employee_id
 * @property integer $wechat_user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\WechatBinding whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatBinding whereEmployeeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatBinding whereWechatUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatBinding whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WechatBinding whereUpdatedAt($value)
 */
class WechatBinding extends Model
{
    protected $table = 'wechat_bindings';

    protected $fillable = ['employee_id', 'wechat_user_id'];
}
