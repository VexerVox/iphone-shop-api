<?php

namespace App\Services;

use App\Models\ProductColor;
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
