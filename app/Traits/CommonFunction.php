<?php

namespace App\Traits;

trait CommonFunction
{

    public function sendResponse(string $message): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function sendError(string $message): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => true,
            'message' => $message,
        ]);
    }


}
