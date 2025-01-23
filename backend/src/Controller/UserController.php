<?php

namespace App\Controller;

use App\Dto\LoginDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\UserService;
use App\Dto\UserDTO;

#[Route('/api/user')]
final class UserController extends AbstractController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/register', name: 'register_user', methods: ['POST'], format: 'json')]
    public function register(#[MapRequestPayload] UserDTO $userDTO): JsonResponse
    {
        $this->userService->register($userDTO);

        return new JsonResponse(['message' => 'Usuário registrado com sucesso!'], JsonResponse::HTTP_CREATED);
    }

    #[Route('/login', name: 'login_user', methods: ['POST'], format: 'json')]
    public function login(#[MapRequestPayload] LoginDTO $loginDTO): JsonResponse
    {
        $user = $this->userService->login($loginDTO);

        return new JsonResponse($user, JsonResponse::HTTP_OK);
    }

}
