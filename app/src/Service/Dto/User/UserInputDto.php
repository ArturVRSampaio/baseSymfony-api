<?php

namespace App\Service\Dto\User;

readonly final class UserInputDto
{
    public function __construct(
        private string $username,
        private array $roles,
        private string $password
    ) {}

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}