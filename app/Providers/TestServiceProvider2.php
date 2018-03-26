<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TestServiceProvider2 extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        echo '程序加载时自动先加载 服务提供者TestServiceProvider2<hr>';
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
