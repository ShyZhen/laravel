<?php
/**
 * Author huaixiu.zhen
 * http://litblc.com
 * User: litblc
 * Date: 2018/1/12
 * Time: 14:24
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class ResponseController extends Controller
{
    public function __construct()
    {
//        echo ('R<br>');
    }
    public function index()
    {
//        dd('response controller');
//        return [1,2,3];
        dd([1,2,3]);
    }

    public function home2()
    {
//        return response('home2', 250)->header('Content-Type', 'text/plain');
        return response()->json([
            'a' => 1,
            'b' => 2
        ]);
    }


    /**
     * 返回响应 携带cookie
     * Author huaixiu.zhen
     * http://litblc.com
     * @return mixed
     */
    public function cookie()
    {
        $content = 'cooooookiee';
        $type = 'text/plain';
        $status = 250;
        $minutes = 1;
        return response($content, $status)
            ->header('Content-Type', $type)
            ->cookie('nameee', 'valueee', $minutes);
    }

    public function getCookie($cookieName)
    {
        return Cookie::get($cookieName);
    }

    public function dashboard()
    {
        return redirect('route/hello', 301);
    }

    public function laracasts()
    {
        flash('sdfsdfsdfsdfsdf')->success();
        flash('sdfsdfsdfsdfsdf')->error();
        flash('sdfsdfsdfsdfsdf')->warning();
        flash('sdfsdfsdfsdfsdf')->important();
        return view('home.lara');
    }
}