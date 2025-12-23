<?php

namespace Ashraful\OnlinePayment\Providers;

use Illuminate\Support\ServiceProvider;

class OnlinePaymentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');

        $this->mergeConfigFrom(
            __DIR__ . '/../Config/paymentmethods.php',
            'paymentmethods'
        );

        // Load views if needed
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'online-payment');

        // Load translations if needed
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'online-payment');

        // Publish assets if needed
        $this->publishes([
            __DIR__ . '/../Resources/assets' => public_path('vendor/online-payment'),
        ], 'online-payment-assets');
    }

    public function register()
    {
        // Register any services here
        $this->registerGateways();
    }

    private function registerGateways()
    {
        // Register gateway implementations
        $this->app->singleton('sslcommerz.gateway', function ($app) {
            return new \Ashraful\OnlinePayment\Gateways\SslCommerzGateway();
        });

        $this->app->singleton('bkash.gateway', function ($app) {
            return new \Ashraful\OnlinePayment\Gateways\BkashGateway();
        });

        $this->app->singleton('nagad.gateway', function ($app) {
            return new \Ashraful\OnlinePayment\Gateways\NagadGateway();
        });

        $this->app->singleton('rocket.gateway', function ($app) {
            return new \Ashraful\OnlinePayment\Gateways\RocketGateway();
        });
    }
}
