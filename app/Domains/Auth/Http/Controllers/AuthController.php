<?php

namespace App\Domains\Auth\Http\Controllers;

use App\Domains\Auth\Http\Requests\ChangePasswordRequest;
use App\Domains\Auth\Http\Requests\ForgotPasswordRequest;
use App\Domains\Auth\Http\Requests\LoginRequest;
use App\Domains\Auth\Http\Requests\RegisterRequest;
use App\Domains\Auth\Http\Resources\AuthResource;
use App\Domains\Auth\Services\AuthService;
use App\Domains\Common\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $service) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->service->login($request->email, $request->password);

        if (is_null($data)) {
            return $this->makeFailResponse([], 401);
        }

        return $this->makeSuccessResponse(AuthResource::make($data));
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        return $this->makeSuccessResponse(
            AuthResource::make(
                $this->service->register($request->email, $request->password)
            ),
        );
    }

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $this->service->forgotPassword($request->email);

        return $this->makeSuccessResponse();
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $this->service->changePassword($request->password);

        return $this->makeSuccessResponse();
    }
}
