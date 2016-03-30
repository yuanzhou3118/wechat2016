<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Employee
 *
 * @property integer $id
 * @property string $id_card
 * @property string $cn_name
 * @property string $en_name
 * @property string $department
 * @property string $txt_1
 * @property string $txt_2
 * @property string $txt_3
 * @property string $txt_4
 * @property string $txt_5
 * @property string $txt_6
 * @property string $txt_7
 * @property string $txt_8
 * @property string $txt_9
 * @property boolean $campaign_status
 * @property integer $type
 * @property boolean $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereIdCard($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereCnName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereEnName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereDepartment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereTxt1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereTxt2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereTxt3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereTxt4($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereTxt5($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereTxt6($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereTxt7($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereTxt8($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereTxt9($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereCampaignStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employee whereUpdatedAt($value)
 */
class Employee extends Model
{
    protected $table = 'employees';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
