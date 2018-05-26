<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * 发送邮件
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $toEmail
     * @param $data
     * @param $subject
     * @return bool
     */
    protected function sendEmail($toEmail, $data, $subject)
    {
        Mail::send('__layout.email', $data, function ($message) use ($toEmail, $subject) {
            $message->to($toEmail)->subject($subject);
        });

        if(count(Mail::failures()) > 0){

            return false;
        }

        return true;
    }

    /**
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param string $prefix
     * @return string
     */
    protected function uuid($prefix = '')
    {
        $chars = md5(uniqid(mt_rand(), true));
        $uuid  = substr($chars,0,8) . '-';
        $uuid .= substr($chars,8,4) . '-';
        $uuid .= substr($chars,12,4) . '-';
        $uuid .= substr($chars,16,4) . '-';
        $uuid .= substr($chars,20,12);
        return $prefix . $uuid;
    }

    /**
     * 随机验证码
     * Author huaixiu.zhen
     * http://litblc.com
     * @return string
     */
    protected function code()
    {
        $code = str_pad(mt_rand(0, 999999), 6, "0", STR_PAD_BOTH);
        return $code;
    }

    /**
     * redis自增
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param $key
     * @return mixed
     */
    protected function redisIncr($key)
    {
        $incr = Redis::incr($key);
        return $incr;
    }
    /**
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $key
     * @return bool
     */
    protected function isRedisExists($key)
    {
        $bool = Redis::exists($key);
        return $bool;
    }

    /**
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $key
     * @param $val
     * @param string $ex
     * @param int $ttl
     * @return string ok
     */
    protected function setRedis($key, $val, $ex = 'EX', $ttl = 600)
    {
        $bool = Redis::set($key, $val, $ex, $ttl);
        return $bool;
    }

    /**
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $key
     * @return string or null
     */
    protected function getRedis($key)
    {
        $res = Redis::get($key);
        return $res;
    }

    /**
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $key
     * @return mixed
     */
    protected function getRedisTtl($key)
    {
        $ttl = Redis::ttl($key);
        return $ttl;
    }

}
