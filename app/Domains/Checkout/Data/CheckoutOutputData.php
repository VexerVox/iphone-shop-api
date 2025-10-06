<?php

namespace App\Domains\Checkout\Data;

use Spatie\LaravelData\Data;

class CheckoutOutputData extends Data
{
    public function __construct(
        public string $orderUuid,
    ) {}
}
