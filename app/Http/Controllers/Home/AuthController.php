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

        if (Auth::guest()) {

            return view('home.login');
        } else {

            return redirect('/home/index');
        }

    }
    public function postLogin (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:12',
            'password' => 'required|max:16',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status_code' => 0,
                'message' => $validator->errors()->first()
            ]);
        }

        $username = $request->username;
        $password = $request->password;
        $remember = $request->remember or false;
        $user = User::where('name', $username);
        if ($user->first() && $user->first()->closure == 'none') {
            if (Auth::attempt(['name' => $username, 'password' => $password], true)) {
                return response()->json([
                    'status_code' => 1,
                    'message' => '登录成功',
                    'url' => asset('home/index')
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


    public function register (Request $request)
    {
        if ($request->isMethod('get')) {
            echo 'get';
        } elseif ($request->isMethod('POST')) {
            echo 'post';
        } else {

            return response()->json([
                'status_code' => 405,
                'message' => 'Method Not Allowed'
            ]);
        }
    }

}