<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BackendUser
 *
 * @property integer $id
 * @property string $account
 * @property string $pwd
 * @property boolean $status
 * @property string $name
 * @property string $ip
 * @property string $last_login
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class BackendUser extends Model
{
    protected $table = 'backend_users';

    protected $fillable = ['account', 'pwd', 'status', 'name', 'ip', 'last_login'];
}
