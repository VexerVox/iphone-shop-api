<?php

namespace App\Domains\Auth\Http\Resources;

use App\Domains\Auth\Data\AuthData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property AuthData $resource*/
class AuthResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'email' => $this->resource->email,
            'authToken' => $this->resource->authToken,
        ];
    }
}
