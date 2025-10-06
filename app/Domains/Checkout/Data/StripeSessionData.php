<?php

namespace App\Domains\Checkout\Data;

use Spatie\LaravelData\Data;

class StripeSessionData extends Data
{
    public function __construct(
        public string $stripeSessionId,
        public string $paymentUrl,
    ) {}
}
