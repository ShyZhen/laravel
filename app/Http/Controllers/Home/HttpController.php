<?php
/**
 * Author huaixiu.zhen
 * http://litblc.com
 * User: litblc
 * Date: 2017/12/29
 * Time: 16:32
 */

namespace App\Http\Controllers\Home;


class HttpController
{
    public function index()
    {
        dd('hello world');
    }

    public function param($pId, $cId)
    {
        dd($pId.' & '.$cId);
    }
    public function redirect()
    {
        return redirect()->route('he');
    }
    public function model()
    {
        dd('model function');
    }
}