<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\V1\UserObserver;
use App\Models\User;

use App\Observers\V1\TaskObserver;
use App\Models\Task;

use App\Interfaces\V1\Auth\AuthServiceInterface;
use App\Services\V1\AuthService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Task::observe(TaskObserver::class);
    }
}
