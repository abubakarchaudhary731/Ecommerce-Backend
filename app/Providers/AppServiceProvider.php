<?php

namespace App\Providers;

use App\Repositories\Main\ProductRepository;
use App\Repositories\Main\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Auth\UserRepository;
use App\Repositories\Auth\UserRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
