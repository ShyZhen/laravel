<?php

/**
 * Author huaixiu.zhen
 * http://litblc.com
 * User: litblc
 * Date: 2017/12/29
 * Time: 10:20
 */

namespace App\Http\Controllers\Admin;

use App\Model\User;

class AdminController
{
    public function index()
    {
        dd('admin namespace');
    }

    public function hello()
    {
        $user = User::find(2);
        dd($user);
    }
}