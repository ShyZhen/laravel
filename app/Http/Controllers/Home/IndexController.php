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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

    /**
     * 测试依赖注入和参数传递
     * Author huaixiu.zhen
     * http://litblc.com
     * @param User $user
     * @param $id
     * @param Request $request
     * @return $this
     */
    public function userInfo (User $user, $id, Request $request)
    {
        dd($request->get('a').$id.$user);
        return view('home.userInfo')->with(['user' => $user]);
    }



    public function testInfo (Test1 $test1)
    {
        return $test1;
    }

    /**
     * 发送邮件
     * Author huaixiu.zhen
     * http://litblc.com
     */
    public function sendEmail ()
    {
        Mail::send('__layout.email', ['data' => '验证码：444'], function ($message) {
            $message->to('835433343@qq.com')->subject('萌面怪兽验证码服务');
        });
    }






}