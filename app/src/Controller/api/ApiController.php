<?php

namespace App\Controller\api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
abstract class ApiController extends AbstractController
{
    protected int $statusCode = Response::HTTP_OK;

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    protected function setStatusCode(int $statusCode): ApiController
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function response(array $data, $headers = []): JsonResponse
    {
        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    public function respondWithErrors(string $errors, $headers = [], \Exception $exception = null): JsonResponse
    {
        $data = [
            'status' => is_null($exception) ? $this->getStatusCode() : $exception->getCode(),
            'errors' => is_null($exception) ? $errors : $exception->getMessage(),
        ];

        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    public function respondWithSuccess(string $success, $headers = []): JsonResponse
    {
        $data = [
            'status' => $this->getStatusCode(),
            'success' => $success,
        ];

        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    public function respondUnauthorized($message = 'Not authorized!'): JsonResponse
    {
        return $this->setStatusCode(Response::HTTP_UNAUTHORIZED)->respondWithErrors($message);
    }

    public function respondValidationError($message = 'Validation errors'): JsonResponse
    {
        return $this->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)->respondWithErrors($message);
    }

    public function respondNotFound($message = 'Not found!'): JsonResponse
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)->respondWithErrors($message);
    }

    public function respondCreated($data = []): JsonResponse
    {
        return $this->setStatusCode(Response::HTTP_CREATED)->response($data);
    }


    protected function transformJsonBody(Request $request): Request
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }
}
