<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Stripe\Stripe;

class StripeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Stripe::setApiKey(config('cashier.secret'));
    }
}
