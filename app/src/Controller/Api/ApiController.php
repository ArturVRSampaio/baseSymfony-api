<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class ApiController extends AbstractController
{
    public function respondWithSuccess(array $data = [], int $status = 200, string $message = 'ok', array $headers = []): JsonResponse
    {
        $response_body = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return new JsonResponse($response_body, $status, $headers);
    }

    public function respondWithException(\Exception $exception, array $headers = []): JsonResponse
    {
        $code = 0 == $exception->getCode() ? 500 : $exception->getCode();

        return $this->respondWithError($exception->getMessage(), $code, $headers);
    }

    public function respondWithError(string $message, int $status = 500, array $headers = []): JsonResponse
    {
        $response_body = [
            'status' => $status,
            'message' => $message,
            'data' => null,
        ];

        return new JsonResponse($response_body, $status, $headers);
    }
}
