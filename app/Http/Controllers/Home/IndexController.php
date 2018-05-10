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

    public function userInfo (User $user)
    {
        return view('home.userInfo')->with(['user' => $user]);
    }



    public function testInfo (Test1 $test1)
    {
        return $test1;
    }

    public function sendEmail ()
    {
//        $order = Order::findOrFail($orderId);
//        Mail::to($request->user())->send(new OrderShipped($order));
//
//        $data = ['email'=>'835433343@qq.com', 'name'=>'testss', 'uid'=>123, 'activationcode'=>123456789];
//        Mail::send('__layout/email', $data, function($message) use($data)
//        {
//            $message->to($data['email'], $data['name'])->subject('欢迎注册我们的网站，请激活您的账号！');
//        });

//        Mail::Raw('Hello World', function ($message) {
//            $message->to('835433343@qq.com')->subject('这是新邮件');
//        });
        Mail::send('__layout.email', ['name' => 'Hello World'], function ($message) {
            $message->to('835433343@qq.com')->subject('您有新邮件3');
        });
    }




}