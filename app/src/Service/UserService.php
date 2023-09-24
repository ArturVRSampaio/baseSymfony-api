<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Dto\User\UserInputDto;

class UserService
{

    public function __construct(
        private UserRepository $userRepository
    ){
    }

    public function createUser(UserInputDto $userInputDto)
    {
        try {
            $user = new User();
            $user->hydrateFromDto($userInputDto);

            $this->userRepository->add($user, true);
        } catch (\Exception $exception) {
            throw new \Exception('Failed to create user');
        }
    }
}