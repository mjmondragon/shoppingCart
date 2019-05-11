<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ShoppingCartRepositoryInterface;
use App\Repositories\ShoppingCartRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ShoppingCartRepositoryInterface::class, function($app) {
            return ShoppingCartRepository::getInstance();
        });
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
