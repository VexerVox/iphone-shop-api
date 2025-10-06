<?php

namespace App\Domains\Checkout\Http\Resources;

use App\Domains\Checkout\Data\CheckoutOutputData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property CheckoutOutputData $resource */
class CheckoutResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'orderUuid' => $this->resource->orderUuid,
        ];
    }
}
