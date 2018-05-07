<?php
/**
 * Author huaixiu.zhen
 * http://litblc.com
 * User: litblc
 * Date: 2018/3/26
 * Time: 17:47
 */

namespace App\Http\Controllers\Home;


use App\Model\Test1;
use App\Model\User;
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
        $user = Auth::user();
        $remember = (Auth::viaRemember());
        return view('home.index')->with(['user' => $user, 'remember' => $remember]);
    }

    public function userInfo (User $user)
    {
        return view('home.userInfo')->with(['user' => $user]);
    }



    public function testInfo (Test1 $test1)
    {
        return $test1;
    }




}