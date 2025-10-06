<?php

namespace App\Domains\Product\Http\Resources;

use App\Domains\Common\Traits\CollectionMetaTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    use CollectionMetaTrait;

    public $collects = ProductResource::class;

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'meta' => $this->getMeta(),
        ];
    }
}
