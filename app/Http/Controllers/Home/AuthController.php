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
use App\Model\PasswordReset;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yuansir\Toastr\Facades\Toastr;


class AuthController extends Controller
{

    public function login(Request $request)
    {
        //session()->flush();  // 防止其他页面调用的toastr方法遗留下来的session,只有快速切换时会出现影响

        if (Auth::guest()) {

            return view('auth.login');
        } else {

            return redirect('/home/index');
        }

    }

    /**
     * 登录
     * Author huaixiu.zhen
     * http://litblc.com
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:255',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status_code' => 400,
                'message' => $validator->errors()->first()
            ]);
        }

        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;
        $user = User::where('email', $email);
        if ($user->first() && $user->first()->closure == 'none') {
            if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
                return response()->json([
                    'status_code' => 1,
                    'message' => '登录成功'.(Auth::viaRemember()),
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


    /**
     * 注册
     * Author huaixiu.zhen
     * http://litblc.com
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function register(Request $request)
    {
        if ($request->isMethod('GET')) {

            if (Auth::guest()) {

                return view('auth.register');
            } else {

                return redirect('/home/index');
            }


        } elseif ($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:16',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|max:255|confirmed',
            ]);
            if ($validator->fails()) {
                //dd($validator->errors()->first());
                return view('auth.register')->with('errors', $validator->errors());
            } else {

                $uuid = $this->uuid('user-');
                $register = User::create([
                    'name' => $request->get('name'),
                    //'password' => password_hash($request->get('password'), PASSWORD_DEFAULT),
                    'password' => bcrypt($request->get('password')),
                    'email' => $request->get('email'),
                    'uuid' => $uuid
                ]);

                Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')], true);

                //flash('注册成功')->success();
                Toastr::success('注册成功', $options = []);
                return redirect('home/index');
                //dd($register.password_hash($request->get('password'), PASSWORD_DEFAULT));
            }

        } else {

            return response()->json([
                'status_code' => 405,
                'message' => 'Method Not Allowed'
            ]);
        }
    }


    public function logout()
    {
        $bool = Auth::logout();
        return redirect('/auth/login');
    }


    /**
     * 发送验证码-忘记密码
     * Author huaixiu.zhen
     * http://litblc.com
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function resetPassword(Request $request)
    {
        if ($request->isMethod('GET')) {

            if (Auth::guest()) {

                return view('auth.passwords.reset');
            } else {

                return redirect('/home/index');
            }

        } elseif ($request->isMethod('POST')) {

//          $preg_tel = '/^1[3|4|5|8|7][0-9]\d{8}$/';
//          $preg_email = '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:255',
            ]);

            if ($validator->fails()) {

                return response()->json([
                    'status_code' => 400,
                    'message' => $validator->errors()->first()
                ]);
            }

            $email = $request->get('email');
            $user = User::where('email', $email)->first();
            if ($user) {
                $code = str_pad(mt_rand(0, 999999), 6, "0", STR_PAD_BOTH);
                $reset = PasswordReset::updateOrCreate([
                    'email' => $email
                ],[
                    'email' => $email,
                    'token' => $code,
                ]);

                $data = [
                    'data' => '验证码:'.$code.'如果这不是您的邮件，请不必担心，该来的迟早会来'
                ];
                $subject = '萌面怪兽忘记密码服务';
                $mail = $this->sendEmail($email, $data, $subject);
                if ($mail) {

                    return response()->json([
                        'status_code' => 200,
                        'message' => '已成功发送邮件'
                    ]);
                }

                return response()->json([
                    'status_code' => 500,
                    'message' => '请重试'
                ]);

            } else {

                return response()->json([
                    'status_code' => 404,
                    'message' => '没有此用户'
                ]);
            }
        }
    }

    public function password(Request $request)
    {
        $validatro = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'verify_code' => 'required|size:6',
            'password' => 'required|min:6|max:255|confirmed',
        ]);

        if ($validatro->fails()) {

            return response()->json([
                'status_code' => 400,
                'message' => $validatro->errors()->first()
            ]);
        } else {
            $email = $request->get('email');
            $verifyCode = $request->get('verify_code');
            $password = $request->get('password');

            $verifyRes = $this->verifyToken($email, $verifyCode);
            if ($verifyRes) {

                $user = User::where('email', $email)->first();
                if ($user) {
                    $user->password = bcrypt($password);
                    $user->save();

                    return response()->json([
                        'status_code' => 200,
                        'message' => '修改成功'
                    ]);
                } else {

                    return response()->json([
                        'status_code' => 404,
                        'message' => '用户未找到'
                    ]);
                }

            } else {

                return response()->json([
                    'status_code' => 400,
                    'message' => '验证码过期或错误'
                ]);
            }
        }

    }

    /**
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $email
     * @param $token
     * @return bool true为验证码通过
     */
    private function verifyToken($email, $token)
    {
        $reset = PasswordReset::where([
            'email' => $email,
            'token' => $token,
        ])->first();

        if ($reset) {
            if ($reset->updated_at->timestamp + 600 > time()) {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }




}