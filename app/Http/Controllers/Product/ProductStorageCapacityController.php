<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductStorageCapacityResource;
use App\Services\ProductStorageCapacityService;

class ProductStorageCapacityController extends Controller
{
    public function __construct(private readonly ProductStorageCapacityService $service) {}

    public function index()
    {
        return $this->makeSuccessResponse(
            ProductStorageCapacityResource::collection($this->service->all())
        );
    }
}
