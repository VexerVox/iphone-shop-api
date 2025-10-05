<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ProductIndexData extends Data
{
    /**
     * @param  array<string>|null  $deviceModels
     * @param  array<string>|null  $colors
     * @param  array<string>|null  $storageCapacities
     */
    public function __construct(
        public ?array $deviceModels,
        public ?array $colors,
        public ?array $storageCapacities,
        public ?int $minPrice,
        public ?int $maxPrice,
        public ?bool $hasEsim,
        public ?bool $hasNanosim,
        public ?bool $hasDualsim,
    ) {}
}
