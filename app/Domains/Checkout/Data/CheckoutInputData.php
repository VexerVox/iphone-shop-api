<?php

namespace App\Domains\Checkout\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class CheckoutInputData extends Data
{
    /**
     * @param  Collection<CheckoutProductData>  $products
     */
    public function __construct(
        public Collection $products,
    ) {}
}
