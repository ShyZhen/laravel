<?php
/**
 * Author huaixiu.zhen
 * http://litblc.com
 * User: litblc
 * Date: 2017/12/29
 * Time: 16:32
 */

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function login (Request $request)
    {
        //session()->flush();  // 防止其他页面调用的toastr方法遗留下来的session,只有快速切换时会出现影响
        return view('home.login');
    }
    public function postLogin (Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $remember = $request->remember or false;
        $user = User::where('name', $username);
        if ($user->first() && $user->closure == 'none') {
            if (Auth::attempt(['name' => $username, 'password' => $password], $remember)) {
                return response()->json([
                    'status_code' => 1,
                    'message' => '登录成功'
                ]);
            } else {
                return response()->json([
                    'status_code' => 0,
                    'message' => '密码错误'
                ]);
            }
        } else {
            return response()->json([
                'status_code' => 0,
                'message' => '用户不存在或者已冻结'
            ]);
        }
    }

}