<?php

/**
 * Author huaixiu.zhen
 * http://litblc.com
 * User: litblc
 * Date: 2017/12/28
 * Time: 14:49
 */

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
     public function __construct ()
     {
         echo 'Home namespace';
     }

    public function index ()
    {
        dd('index');
    }
}