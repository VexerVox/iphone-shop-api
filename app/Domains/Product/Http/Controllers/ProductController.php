<?php

namespace App\Domains\Product\Http\Controllers;

use App\Domains\Common\Http\Controllers\Controller;
use App\Domains\Product\Data\ProductIndexData;
use App\Domains\Product\Http\Requests\ProductListRequest;
use App\Domains\Product\Http\Resources\ProductCollection;
use App\Domains\Product\Http\Resources\ProductResource;
use App\Domains\Product\Models\Product;
use App\Domains\Product\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(private readonly ProductService $service) {}

    public function list(ProductListRequest $request)
    {
        return $this->makeSuccessResponse(
            new ProductCollection(
                $this->service->index(ProductIndexData::from($request))
            )
        );
    }

    public function show(Product $product)
    {
        return $this->makeSuccessResponse(
            ProductResource::make($this->service->show($product))
        );
    }
}
