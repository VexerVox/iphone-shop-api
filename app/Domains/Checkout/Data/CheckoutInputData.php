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

        public string $email,
        public string $phone,

        public string $firstName,
        public string $lastName,
        public string $addressLine1,
        public ?string $addressLine2,
        public string $city,
        public string $zipCode,
        public string $country,
    ) {}
}
