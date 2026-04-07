<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
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

        RateLimiter::for('api', function (Request $request) {
                return $request->user()?->isAdmin() 
                ? Limit::none()
                : Limit::perMinute(100)->by($request->user()?->id ?: $request->ip());
        });

        Gate::define('view-stats', function (User $user): bool {
            return $user->isAdmin();
        });

    }
}
