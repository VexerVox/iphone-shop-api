<?php

namespace App\Domains\Product\Http\Resources;

use App\Domains\Product\Models\DeviceModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property DeviceModel $resource */
class DeviceModelResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'slug' => $this->resource->slug,
        ];
    }
}
