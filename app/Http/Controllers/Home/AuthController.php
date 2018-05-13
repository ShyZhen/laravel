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
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

    public function login (Request $request)
    {
        //session()->flush();  // 防止其他页面调用的toastr方法遗留下来的session,只有快速切换时会出现影响
        return view('home.login');
    }
    public function postLogin (Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required|max:64',
            'password' => 'required|max:64',
        ],[
            'username.require' => '用户名不为空',
            'username.max' => '用户名长度64',
            'password.require' => '密码不为空',
            'password.max' => '密码长度64',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 422,
                'message' => $validator->errors()
            ]);
        }

        $username = $request->username;
        $password = $request->password;
        $remember = $request->remember or false;
        $user = User::where('username', $username);
        if ($user->first() && $user->closure == 'none') {
            if (Auth::attempt(['username' => $username, 'password' => $password], $remember)) {
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