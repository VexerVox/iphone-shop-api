<?php

namespace App\Domains\Checkout\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class OrderCalculateData extends Data
{
    /**
     * @param  Collection<ProductCalculateData>  $calculatedProducts
     */
    public function __construct(
        public Collection $calculatedProducts,
        public int $totalPrice,
    ) {}
}
