<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class RateLimitServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $localEnvironment = $this->app->environment('local');

        RateLimiter::for('forgot-password', function (Request $request) use ($localEnvironment) {
            return ! $localEnvironment
                ? Limit::perHour(3)->by($request->ip())
                : Limit::none();
        });
    }
}
