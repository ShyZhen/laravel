<?php
/**
 * Author huaixiu.zhen
 * http://litblc.com
 * User: litblc
 * Date: 2018/3/26
 * Time: 11:00
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;

class ProfileComposer
{
    public function compose(View $view)
    {
        $view->with('compose', '视图合成器，初始化某个文件时携带的参数,屌index');
    }
}