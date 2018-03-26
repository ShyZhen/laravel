<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        echo '<p>'.date('Y-m-d H:i:s', time()).' 默认服务提供者AppServiceProvider，已经被注册在config/app.php中；观察者方法可以写入</p>';
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
