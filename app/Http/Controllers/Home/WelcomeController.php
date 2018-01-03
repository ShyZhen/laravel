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
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class WelcomeController extends Controller
{
     public function __construct()
     {
//         echo 'Home namespace';
     }

    public function attempt()
    {
//        dd(Carbon::now());
//        dd(env('APP_KEY'));
//        abort(404);

//        $message = ['aaa' => 'something error'.env('APP_KEY')];
//        Log::emergency($message);
//        Log::alert($message);
//        Log::critical($message);
//        Log::error($message);
//        Log::warning($message);
//        Log::notice($message);
//        Log::info($message);
//        Log::debug($message);
//        echo 'aaa';
//        $users = User::find(1);
        $remember = session('remember');
        $bool = Auth::attempt(['email' => '876121290@qq.com', 'password' => 'huaixiu'], 111);
        echo $bool;  // 1

    }

    public function authUser()
    {
        dd(Auth::user().'<hr>'.Auth::viaRemember());
    }

    public function logout()
    {
        $bool = Auth::logout();
        var_dump($bool);
    }

    public function index()
    {
//        $user = User::find(1);
//        dd($user);

//        $bool = Hash::check('huaixiu', '$2y$10$9V5NGqDPdF3pT5dFI/TsAer1zBsLem3d.nDXkhYRW0fOYJ3Lfv0km');
//        dd($bool);

        $str = Hash::make('huaixiu');
        dd($str);
    }

    public function getCache()
    {
        $user =  Cache::get('user');
        dd($user);
    }
    public function putCache() {
        Cache::put('user', 'redis???', 10);
    }

    public function putRedis()
    {
        $res = Redis::set('name:1', 'huaixiutime', 'EX', 10);
        dd($res);
    }

    public function getRedis()
    {
        $test = Redis::get('name:1');
        dd($test);
    }

    public function csrf()
    {
        dd(csrf_field());
    }
}