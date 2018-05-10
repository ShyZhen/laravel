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
     * 发送邮件
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $toEmail
     * @param $data array
     * @param $subject
     */
    protected function sendEmail ($toEmail, $data, $subject)
    {
        Mail::send('__layout.email', $data, function ($message) use ($toEmail, $subject) {
            $message->to($toEmail)->subject($subject);
        });

        if(count(Mail::failures()) > 0){

            return false;
        }

        return true;
    }
}
