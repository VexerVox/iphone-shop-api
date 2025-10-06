<?php

namespace App\Domains\Product\Services;

use App\Domains\Product\Models\ProductStorageCapacity;
use Illuminate\Database\Eloquent\Collection;

class ProductStorageCapacityService
{
    /**
     * @return Collection<ProductStorageCapacity>
     */
    public function all(): Collection
    {
        return ProductStorageCapacity::all();
    }
}
