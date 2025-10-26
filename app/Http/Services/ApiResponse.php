<?php

namespace App\Http\Services;

use Illuminate\Http\JsonResponse;

class ApiResponse
{

    public static function success($data = [], $status_code = 200, $message = ""): JsonResponse
    {
        return response()->json([
            compact('status_code', 'message', 'data')
        ], $status_code);
    }

    public static function error($status_code = 500, $message = ""): JsonResponse
    {
        return response()->json([
            compact('status_code', 'message')
        ], $status_code);
    }
}