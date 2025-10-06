<?php

namespace App\Domains\Checkout\Data;

use Spatie\LaravelData\Data;

class CheckoutProductData extends Data
{
    public function __construct(
        public string $slug,
        public int $quantity,
    ) {}
}
