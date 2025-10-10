<?php

namespace App\Domains\Product\Http\Resources;

use App\Domains\Common\Traits\ResourceCollectionMetaTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    use ResourceCollectionMetaTrait;

    public $collects = ProductResource::class;

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'meta' => $this->getMeta(),
        ];
    }
}
