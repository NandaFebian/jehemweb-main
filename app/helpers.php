<?php

if (! function_exists('api_response')) {
    function api_response($statusCode = 200, array $data = [], ?string $message = null)
    {
        return response()->json([
            'status_code' => $statusCode,
            'data' => $data,
            'message' => $message,
        ], $statusCode);
    }
}
