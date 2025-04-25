<?php

namespace App\Providers;

use App\Repositories\ActivityRepository;
use App\Repositories\Interfaces\ActivityRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ActivityRepositoryInterface::class , ActivityRepository::class);
    }
    public function boot(): void
    {
        //
    }
}
