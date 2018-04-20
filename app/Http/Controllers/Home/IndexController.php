<?php
/**
 * Author huaixiu.zhen
 * http://litblc.com
 * User: litblc
 * Date: 2018/3/26
 * Time: 17:47
 */

namespace App\Http\Controllers\Home;


use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class IndexController
{
    public function compose(View $view)
    {
        $a = '初始化数据';
        $view->with('a', $a);
    }

    public function index ()
    {
        dd(Auth::guard()->guest());
        dd(Auth::check());


    }
}