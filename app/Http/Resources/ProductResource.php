<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Product */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'deviceModel' => DeviceModelResource::make($this->whenLoaded('deviceModel')),
            'storageCapacity' => ProductStorageCapacityResource::make($this->whenLoaded('storageCapacity')),
            'color' => ProductColorResource::make($this->whenLoaded('color')),
            'price' => $this->price,
            'discounted_price' => $this->discounted_price,
            'hasEsim' => (bool) $this->has_esim,
            'hasNanosim' => (bool) $this->has_nanosim,
            'hasDualsim' => (bool) $this->has_dualsim,
        ];
    }
}
