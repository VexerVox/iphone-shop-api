<?php

namespace App\Domains\Product\Services;

use App\Domains\Product\Models\ProductColor;
use Illuminate\Database\Eloquent\Collection;

class ProductColorService
{
    /**
     * @return Collection<ProductColor>
     */
    public function all(): Collection
    {
        return ProductColor::all();
    }
}
