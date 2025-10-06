<?php

namespace App\Domains\Product\Http\Resources;

use App\Domains\Product\Models\ProductStorageCapacity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property ProductStorageCapacity $resource */
class ProductStorageCapacityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'slug' => $this->resource->slug,
        ];
    }
}
