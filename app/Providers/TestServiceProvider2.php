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
        echo 'ssssllllprovider2';
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
