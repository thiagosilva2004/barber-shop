<?php

namespace app\presentation\helper;

use Illuminate\Http\JsonResponse;

class HttpResponseError
{
    public static function execute(int $status, string $code, string $message): JsonResponse
    {
        return response()->json([
            'code'    => $code,
            'message' => $message
        ], $status);
    }
}
