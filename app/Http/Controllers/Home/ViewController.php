<?php
/**
 * Author huaixiu.zhen
 * http://litblc.com
 * User: litblc
 * Date: 2018/3/21
 * Time: 18:30
 */

namespace App\Http\Controllers\Home;


class ViewController
{
    public function index()
    {
        echo ('view');
    }

    public function test1()
    {
        return view('home.test',['a'=>123])->with('b', '456');
    }
}