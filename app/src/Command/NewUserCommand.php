<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:new:user',
    description: 'create new user',
)]
class NewUserCommand extends Command
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly UserRepository              $userRepository
    ) {
        parent::__construct('app:new:user');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $username = $io->ask('Enter user username');
        $password = $io->ask('User password');
        $role = $io->ask('Enter role user (Ex: ROLE_ADMIN)');
        $io->writeln("creating user with this username: $username and this password: $password and role $role");

        $user = new User();
        $user->setUsername($username);
        $user->setRoles([$role]);
        $user->setPassword(
            $this->passwordHasher
                ->hashPassword($user, $password)
        );
        $this->userRepository->add($user, true);

        $io->success('User Created!!!');

        return Command::SUCCESS;
    }
}