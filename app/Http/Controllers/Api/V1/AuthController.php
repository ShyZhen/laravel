<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Model\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Created by huaixiu.zhen@gmail.com
 * http://litblc.com
 * User: huaixiu.zhen
 * Date: 2018/5/19
 * Time: 22:07
 */
class AuthController extends Controller
{

    protected $passportParams;

    protected $http;

    /**
     * 初始化
     */
    public function __construct()
    {
        $this->passportParams = config('passport');
        $this->http = new Client();
    }

    /**
     * 登录，客户端可以判断是web还是app,web存sessionStorage,app存local
     * 再次判断是否有token,没有才访问login
     * 所有鉴权失败都跳转到login
     * 所有需要鉴权的操作需要在header携带登录所生成的access_token
     * headers => [
     *    'Accept' => 'application/json',
     *    'Authorization' => 'Bearer '.$accessToken,
     * ],
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        // TODO 重复登录刷api问题
        // TODO 清理过期token监听事件
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

        $email = $request->get('email');
        $password = $request->get('password');
        $user = User::where('email', $email);
        if ($user->first() && $user->first()->closure == 'none') {

            // 暴力破解处理
            if ($this->isRedisExists($email.':login:number')) {
                $this->redisIncr($email.':login:number');
                if ($this->getRedis($email.':login:number') >= 10) {
                    return response()->json([
                        'status_code' => 403,
                        'message' => '您请求次数过多，请稍后重试，祝您生活愉快'
                    ]);
                }
            } else {
                $this->setRedis($email.':login:number', 1, 'EX', 600);
            }

            $userInfo = [
                'username' => $email,
                'password' => $password,
            ];
            $url = url('oauth/token');
            $data = ['form_params' => array_merge($this->passportParams, $userInfo)];
            $response = $this->http->post($url, $data);
            return response()->json($response->getBody()->getContents());
        } else {

            return response()->json([
                'status_code' => 0,
                'message' => '用户不存在或者已冻结'
            ]);
        }
    }

    /**
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard('api')->user()->token()->delete();

        return response()->json([
            'message' => '登出成功',
            'status_code' => 200,
        ]);
    }

    /**
     * 发送注册验证码
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => $validator->errors()->first()
            ]);
        } else {
            $email = $request->get('email');
            if ($this->isRedisExists('user:email:'.$email)) {
                return response()->json([
                    'status_code' => 400,
                    'message' => '请检查您的邮箱，距离下一次请求时间为：'.$this->getRedisTtl('user:email:'.$email).'s'
                ]);
            } else {
                $code = $this->code();
                $this->setRedis('user:email:'.$email, $code, 'EX', 600);
                $data = [
                    'data' => '验证码:'.$code.'如果这不是您的邮件，请不必担心，该来的迟早会来'
                ];
                $subject = '萌面怪兽注册服务';
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
            }
        }
    }

    /**
     * 注册验证逻辑
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:16',
            'verify_code' => 'required|size:6',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:255|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => $validator->errors()->first()
            ]);
        } else {

            $code = $this->getRedis('user:email:'.$request->get('email'));
            if ($code) {
                if ($code == $request->get('verify_code')) {
                    $uuid = $this->uuid('user-');
                    $user = User::create([
                        'name' => $request->get('name'),
                        //'password' => password_hash($request->get('password'), PASSWORD_DEFAULT),
                        'password' => bcrypt($request->get('password')),
                        'email' => $request->get('email'),
                        'uuid' => $uuid
                    ]);
                    $token = $user->createToken('Token Name')->accessToken;

                    return response()->json([
                        'status_code' => 200,
                        'access_token' => $token
                    ]);
                } else {
                    return response()->json([
                        'status_code' => 401,
                        'message' => '验证码错误'
                    ]);
                }
            } else {

                return response()->json([
                    'status_code' => 400,
                    'message' => '验证码不存在或已过期'
                ]);
            }
        }
    }

    /**
     * 忘记密码发送验证码
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function passwordCode(Request $request)
    {
//      $preg_tel = '/^1[3|4|5|8|7][0-9]\d{8}$/';
//      $preg_email = '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|exists:users,email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => $validator->errors()->first()
            ]);
        }

        $email = $request->get('email');
        if ($this->getRedis('password:email:'.$email)) {
            return response()->json([
                'status_code' => 400,
                'message' => '请检查您的邮箱，距离下一次请求时间为：'.$this->getRedisTtl('password:email:'.$email).'s'
            ]);
        } else {
            $code = $this->code();
            $this->setRedis('password:email:'.$email, $code, 'EX', 600);
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
                'message' => '网络错误，请重试'
            ]);
        }
    }

    /**
     * 修改密码逻辑
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function password(Request $request)
    {
        $validatro = Validator::make($request->all(), [
            'email' => 'required|email|max:255|exists:users,email',
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

            $code = $this->getRedis('password:email:'.$request->get('email'));
            if ($code) {
                if ($code == $verifyCode) {
                    $user = User::where('email', $email)->first();
                    $user->password = bcrypt($password);
                    $user->save();
                    return response()->json([
                        'status_code' => 200,
                        'message' => '修改成功'
                    ]);
                } else {
                    return response()->json([
                        'status_code' => 401,
                        'message' => '验证码错误'
                    ]);
                }
            } else {

                return response()->json([
                    'status_code' => 400,
                    'message' => '验证码不存在或已过期'
                ]);
            }
        }
    }

    /**
     * 获取当前用户信息
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @return mixed
     */
    public function userInfo()
    {
        return Auth::user();
    }
}