<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeviceModelResource;
use App\Services\DeviceModelService;

class DeviceModelController extends Controller
{
    public function __construct(private readonly DeviceModelService $service) {}

    public function index()
    {
        return $this->makeSuccessResponse(
            DeviceModelResource::collection($this->service->all())
        );
    }
}
