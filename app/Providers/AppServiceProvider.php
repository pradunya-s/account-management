<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Repositories\AccountRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\TransactionRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
