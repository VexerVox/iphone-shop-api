<?php

namespace App\Domains\Product\Http\Resources;

use App\Domains\Product\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property ProductColor $resource */
class ProductColorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'slug' => $this->resource->slug,
        ];
    }
}
