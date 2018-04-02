<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
//    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //echo '<p>自定义服务提供者TestServiceProvider，自己注册到app.php中</p>';
        View::share('shareValue1', 'huaixiu.zhen');
        view()->share('shareValue2', 'litblc.com');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
