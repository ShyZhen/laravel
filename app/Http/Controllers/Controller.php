<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * 发�?�邮�?
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $toEmail
     * @param $data array
     * @param $subject
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
}
