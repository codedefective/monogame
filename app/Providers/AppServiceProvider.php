<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        $this->app->bind(
            'App\Repositories\Interfaces\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\AdminRepositoryInterface',
            'App\Repositories\AdministratorRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\PromotionInterface',
            'App\Repositories\PromotionRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\WalletRepositoryInterface',
            'App\Repositories\WalletRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\WalletTransactionRepositoryInterface',
            'App\Repositories\WalletTransactionsRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
