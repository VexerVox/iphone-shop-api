<?php

namespace App\Domains\Product\Http\Resources;

use App\Domains\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Product $resource */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'slug' => $this->resource->slug,
            'deviceModel' => DeviceModelResource::make($this->whenLoaded('deviceModel')),
            'storageCapacity' => ProductStorageCapacityResource::make($this->whenLoaded('storageCapacity')),
            'color' => ProductColorResource::make($this->whenLoaded('color')),
            'price' => $this->resource->price,
            'discounted_price' => $this->resource->discounted_price,
            'hasEsim' => (bool) $this->resource->has_esim,
            'hasNanosim' => (bool) $this->resource->has_nanosim,
            'hasDualsim' => (bool) $this->resource->has_dualsim,
        ];
    }
}
