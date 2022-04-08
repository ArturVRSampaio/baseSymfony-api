<?php

namespace App\Controller\api;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class teste extends AbstractController
{
    
    public function __construct(Private EntityManagerInterface $em, Private UserPasswordHasherInterface $encoder)
{
}

#[Route('/api/rotinha', name: 'register', methods: 'POST')]
public function register(Request $request): JsonResponse
{
    
    return new JsonResponse(["ola"]);
}

    

}