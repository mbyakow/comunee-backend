<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Helper;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseFactory
{
    /**
     * @param array $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function createOkResponse(
        $data = [],
        string $message = '',
        int $statusCode = Response::HTTP_OK
    ): JsonResponse {
        return JsonResponse::create([
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * @param array $errors
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function createErrorResponse(
        $errors = [],
        string $message = '',
        int $statusCode = Response::HTTP_BAD_REQUEST
    ): JsonResponse
    {
        return JsonResponse::create([
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }
}
