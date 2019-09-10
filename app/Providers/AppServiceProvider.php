<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CartManager;
use Route;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::bind('product', function($value) {
            return \App\Product::where('id', $value)->orWhere('slug', $value)->first();
        });

        Route::bind('category', function($value) {
            return \App\Category::where('id', $value)->orWhere('slug', $value)->first();
        });//
    }
}
