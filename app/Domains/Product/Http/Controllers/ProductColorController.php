<?php

namespace App\Domains\Product\Http\Controllers;

use App\Domains\Common\Http\Controllers\Controller;
use App\Domains\Product\Http\Resources\ProductColorResource;
use App\Domains\Product\Services\ProductColorService;

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
