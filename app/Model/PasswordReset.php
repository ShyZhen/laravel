<?php

/**
 * Author huaixiu.zhen
 * http://litblc.com
 * User: litblc
 * Date: 2017/12/28
 * Time: 16:50
 */

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PasswordReset extends Authenticatable
{
    use Notifiable;

    protected $table = 'password_resets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'token',
    ];

}
