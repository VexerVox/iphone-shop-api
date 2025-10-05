<?php

namespace App\Http\Controllers\Product;

use App\Data\ProductIndexData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\IndexRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(private readonly ProductService $service) {}

    public function index(IndexRequest $request)
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
