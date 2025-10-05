<?php

namespace App\Services;

use App\Models\ProductStorageCapacity;
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
