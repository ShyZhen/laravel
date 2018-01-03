<?php
/**
 * Author huaixiu.zhen
 * http://litblc.com
 * User: litblc
 * Date: 2017/12/29
 * Time: 16:32
 */

namespace App\Http\Controllers\Home;



use Illuminate\Http\Request;

class HttpController
{
    public function index()
    {
        dd('hello world');
    }

    public function param(Request $request, $pId, $cId)
    {
        dd($pId.' & '.$cId.' & '.$request->age);
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