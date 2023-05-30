<?php

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Dto\User\UserInputDto;
use App\Service\UserService;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{

    public function testCreateAnUser(): void
    {
        // Cria um mock do UserRepository
        $userRepository = $this->createMock(UserRepository::class);
        $userRepository->expects($this->once())
            ->method('add')
            ->willReturnCallback(function ($user, $flush) {
                $this->assertInstanceOf(User::class, $user);
                $this->assertTrue($flush);
            });

        // Cria um UserService com o UserRepository mockado
        $userService = new UserService($userRepository);

        // Cria uma instância de UserInputDto para os dados do usuário
        $userInputDto = new UserInputDto('any_user', ['ROLE_ADMIN'], '123456');

        // Chama o método createUser no UserService
        $userService->createUser($userInputDto);
    }

    public function testCreateUserException()
    {
        // Cria um mock do UserRepository
        $userRepository = $this->createMock(UserRepository::class);
        $userRepository->expects($this->once())
            ->method('add')
            ->willThrowException(new \Exception('Failed to create user'));

        // Cria um UserService com o UserRepository mockado
        $userService = new UserService($userRepository);

        // Cria uma instância de UserInputDto para os dados do usuário
        $userInputDto = new UserInputDto('john_doe', ['ROLE_ADMIN'], '123456');

        // Testa se a exceção é lançada ao criar o usuário
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Failed to create user');

        // Chama o método createUser no UserService
        $userService->createUser($userInputDto);
    }
}