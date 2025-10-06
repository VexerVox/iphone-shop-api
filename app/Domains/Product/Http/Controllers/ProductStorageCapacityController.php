<?php

namespace App\Domains\Product\Http\Controllers;

use App\Domains\Common\Http\Controllers\Controller;
use App\Domains\Product\Http\Resources\ProductStorageCapacityResource;
use App\Domains\Product\Services\ProductStorageCapacityService;
use Illuminate\Http\JsonResponse;

class ProductStorageCapacityController extends Controller
{
    public function __construct(private readonly ProductStorageCapacityService $service) {}

    public function index(): JsonResponse
    {
        return $this->makeSuccessResponse(
            ProductStorageCapacityResource::collection($this->service->all())
        );
    }
}
