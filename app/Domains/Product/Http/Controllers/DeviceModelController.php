<?php

namespace App\Domains\Product\Http\Controllers;

use App\Domains\Common\Http\Controllers\Controller;
use App\Domains\Product\Http\Resources\DeviceModelResource;
use App\Domains\Product\Services\DeviceModelService;

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
