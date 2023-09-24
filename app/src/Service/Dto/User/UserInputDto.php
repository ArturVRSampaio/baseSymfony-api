<?php

namespace App\Service\Dto\User;

readonly final class UserInputDto
{
    public function __construct(
        private string $username,
        private array $roles,
        private string $password
    ) {}

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}