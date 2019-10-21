<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CartManager;
use Admin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cart', function ($app) {
            return $app->make(CartManager::class);
        });

        // Register admin resources...
        Admin::resources([
            \App\Admin\Product::class,
            \App\Admin\Category::class,
            \App\Admin\Order::class,
            \App\Admin\OrderItem::class,
            \App\Admin\User::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
