<?php

namespace App\Domains\Common\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class Controller
{
    protected function makeSuccessResponse($data = null): JsonResponse
    {
        return $this->makeResponse($data, true, 200);
    }

    protected function makeFailResponse($data = null, $status = 400): JsonResponse
    {
        return $this->makeResponse($data, false, $status);
    }

    protected function makeResponse($data = null, bool $success = true, int $status = 200): JsonResponse
    {
        if (is_null($data)) {
            $response = [
                'success' => $success,
            ];
        } elseif ($data?->resource instanceof LengthAwarePaginator) {
            $response['success'] = $success;
            $response += $data->toArray(request());
        } else {
            $response = [
                'success' => $success,
                'data' => $data,
            ];
        }

        return response()->json($response, $status);
    }
}
