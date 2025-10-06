<?php

namespace App\Domains\Checkout\Data;

use App\Domains\Product\Models\Product;
use Spatie\LaravelData\Data;

class ProductCalculateData extends Data
{
    public function __construct(
        public Product $product,
        public int $quantity,
        public int $totalPrice,
        public int $perProductPrice,
    ) {}
}
