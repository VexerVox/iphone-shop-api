<?php

namespace App\Http\Resources;

use App\Models\ProductStorageCapacity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ProductStorageCapacity
 */
class ProductStorageCapacityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }
}
