<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class SessionController extends Controller
{
    //
    public function index()
    {
        dd('session');
    }
    public function all(Request $request)
    {
        $data = $request->session()->all();
        dd($data);
    }
    public function getSession(Request $request)
    {
        $data = $request->session()->get('abcqwer');
        $data2 = $request->session()->get('ty');
        dd($data);
    }

    /**
     * Session 目前已经存在了redis中
     * Author huaixiu.zhen
     * http://litblc.com
     * @param Request $request
     */
    public function setSession(Request $request)
    {
        $arr = [
            'a' => '1233er',
            'b' => 'sssffr1f',
            '1111111' => 'sssffr1f',
            'c' => 5665000
        ];

        $res = session(['abcqwer' =>  $arr]);
        $request->session()->put('ty', 'ttttttttttttttt');
        var_dump($res);

        Redis::set('name:123456', 'huaixiutime', 'EX', 10);
        Redis::set('name:789456', 'litblc', 'EX', 10);
    }
}
