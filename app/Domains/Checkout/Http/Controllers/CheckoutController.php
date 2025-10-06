<?php

namespace App\Domains\Checkout\Http\Controllers;

use App\Domains\Checkout\Data\CheckoutInputData;
use App\Domains\Checkout\Http\Requests\CheckoutRequest;
use App\Domains\Checkout\Http\Resources\CheckoutResource;
use App\Domains\Checkout\Services\CheckoutService;
use App\Domains\Common\Http\Controllers\Controller;
use Throwable;

class CheckoutController extends Controller
{
    public function __construct(private readonly CheckoutService $service) {}

    /**
     * @throws Throwable
     */
    public function checkout(CheckoutRequest $request)
    {
        return $this->makeSuccessResponse(
            CheckoutResource::make(
                $this->service->checkout(CheckoutInputData::from($request))
            )
        );
    }
}
