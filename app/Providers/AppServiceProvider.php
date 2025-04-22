<?php

namespace App\Providers;

use App\Repositories\ActivityRepository;
use App\Repositories\Interfaces\ActivityRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ActivityRepositoryInterface::class , ActivityRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
