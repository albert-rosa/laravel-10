<?php

namespace App\Providers;

use App\Repositories\PaginationInterface;
use App\Repositories\PaginationPresenter;
use App\Repositories\SupportEloquentORM;
use App\Repositories\SupportRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(SupportRepositoryInterface::class, SupportEloquentORM::class);
        $this->app->bind(PaginationInterface::class, PaginationPresenter::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
