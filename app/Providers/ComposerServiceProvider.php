<?php
/**
 * Author huaixiu.zhen
 * http://litblc.com
 * User: litblc
 * Date: 2018/3/26
 * Time: 10:23
 */

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * 视图合成器 在home/test这个view渲染时执行后面控制器的compose方法
     * Author huaixiu.zhen
     * http://litblc.com
     */
    public function boot()
    {
        View::composer(
          'home/test', 'App\Http\ViewComposers\ProfileComposer'
        );

        View::composer(
            'home/index', 'App\Http\Controllers\Home\IndexController'
        );

    }

    public function register()
    {

    }
}