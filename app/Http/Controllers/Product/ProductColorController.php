<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductColorResource;
use App\Services\ProductColorService;

class ProductColorController extends Controller
{
    public function __construct(private readonly ProductColorService $service) {}

    public function index()
    {
        return $this->makeSuccessResponse(
            ProductColorResource::collection($this->service->all())
        );
    }
}
