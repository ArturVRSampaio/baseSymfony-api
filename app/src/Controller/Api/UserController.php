<?php

namespace App\Controller\Api;

use App\Repository\UserRepository;
use App\Service\Dto\User\UserInputDto;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users')]
class UserController extends ApiController
{

    public function __construct(private readonly UserRepository $userRepository,
                                private readonly UserService    $userService)
    {
    }

    #[Route('/new', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent());

        $userInputDto = new UserInputDto($data->username, $data->roles, $data->password);

        $this->userService->createUser($userInputDto);

        return new JsonResponse([], 201, 'usuário criado com sucesso');
    }

        #[Route('/all', methods: ['GET'])]
    public function getall(): Response
    {
        return  $this->respondWithSuccess($this->userRepository->findAll());
    }
}
