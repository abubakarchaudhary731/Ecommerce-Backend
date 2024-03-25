<?php

namespace App\Providers;

use App\Repositories\Auth\UserDetailRepository;
use App\Repositories\Auth\UserDetailRepositoryInterface;
use App\Repositories\Main\Checkout\CheckoutRepository;
use App\Repositories\Main\Checkout\CheckoutRepositoryInterface;
use App\Repositories\Main\Order\OrderRepository;
use App\Repositories\Main\Order\OrderRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Auth\UserRepository;
use App\Repositories\Main\ProductRepository;
use App\Repositories\Main\Cart\CartRepository;
use App\Repositories\Auth\UserRepositoryInterface;
use App\Repositories\Main\ProductRepositoryInterface;
use App\Repositories\Main\Cart\CartRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserDetailRepositoryInterface::class, UserDetailRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(CheckoutRepositoryInterface::class, CheckoutRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
