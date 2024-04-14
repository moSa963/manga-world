<?php

namespace App\Providers;

use App\Models\Series;
use App\Models\User;
use App\Observers\SeriesObserver;
use App\Policies\UsersPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Series::observe(SeriesObserver::class);
        Gate::policy(User::class, UsersPolicy::class);
    }
}
