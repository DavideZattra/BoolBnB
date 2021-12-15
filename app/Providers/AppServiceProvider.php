<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'xtb6mz33jvnv7kz4',
            'publicKey' => 'vyj99b6yqhnwsgcs',
            'privateKey' => '5950ef3e257855ac1bcdf4a0c64ea5c2'
        ]);
    }
}
