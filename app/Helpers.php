<?php
// app/Helpers.php

use Illuminate\Support\Facades\Crypt;

if (!function_exists('encryptId')) {
    /**
     * Encrypt an ID.
     *
     * @param int $id
     * @return string
     */
    function encryptId(int $id): string
    {
        return Crypt::encrypt($id);
    }
}

if (!function_exists('decryptId')) {
    /**
     * Decrypt an ID.
     *
     * @param string $encryptedId
     * @return int|null
     */
    function decryptId(string $encryptedId): ?int
    {
        try {
            return Crypt::decrypt($encryptedId);
        } catch (\Exception $e) {
            return null;
        }
    }
}


if (!function_exists('logError')) {
    function logError($controllerName, $functionName, $exception): void
    {
        tap(logger(), function ($logger) use ($controllerName, $functionName, $exception) {
            $logger->error(
                "$controllerName:$functionName: Exception occurred",
                [
                    'error_message' => $exception->getMessage(),
                    'request' => request()->all(),
                ]
            );
        });
    }
}

