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


    /**测试依赖注入和参数传递
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param Test1 $test1
     * @return Test1
     */
    public function testInfo (Test1 $test1)
    {
        return $test1;
    }

    /**
     * 发送邮件测试
     * Author huaixiu.zhen
     * http://litblc.com
     */
    public function sendEmail ()
    {
        $mail = Mail::send('__layout.email', ['data' => '验证码：444'], function ($message) {
            $message->to('835433343@qq.com')->subject('萌面怪兽验证码服务');
        });
        return $mail;
    }


    /**
     * 个人中心
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @return $this
     */
    public function myInfo ()
    {
        $user = Auth::user();
        return view('home.myinfo')->with(['user' => $user]);
    }

    /**
     * 给定值是否是该数组下两者之和
     * Author huaixiu.zhen
     * http://litblc.com
     * @param array $a
     * @param int $x
     * @return string
     */
    public function jndge($a = [], $x = 0)
    {
        $a = [2, 3, 7, 10, 8, 19, 11, 13, 23, 30, 45, 90];
        $x = 5;
        rsort($a);
        foreach ($a as $key => $val) {
            if (in_array($x - $val, $a)) {
                return $val.'+'.($x - $val);
            }
        }
        return 'false';

//        $arr = [2, 3, 7, 10, 8, 19, 11, 13, 23, 30, 45, 90];
//        sort($arr);
//        $num = 5;
//        $index = array_search($num, $arr) !== false ? array_search($num, $arr) : count($arr) - 1;
//
//        for ($i = 0, $j = $index; $i < $index; $i++, $j--) {
//            if ($arr[$i] + $arr[$j] > $num) {
//                $i--;
//            } else if ($arr[$i] + $arr[$j] < $num) {
//                $j++;
//            } else {
//                return $arr[$i].'+'.$arr[$j];
//            }
//
//        }
//        return 'false';

    }







}