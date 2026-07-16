<?php

namespace App\Controller;

use App\Attribute\ApiResponse;
use App\DTO\Request\Auth\RegisterDTO;
use App\DTO\Response\UserResponseDTO;
use App\Entity\User;
use App\Service\Auth\RegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

final class AuthController extends AbstractController
{
    #[Route('/api/register', name: 'register', methods: ['POST'])]
    #[ApiResponse(status: Response::HTTP_CREATED)]
    public function register(
        #[MapRequestPayload] RegisterDTO $dto,
        RegisterService $registerService
    ): UserResponseDTO {
        $user = $registerService->run($dto);
        return UserResponseDTO::fromEntity($user);
    }

    #[Route('/api/users/me', name: 'get-profile', methods: ['GET'])]
    #[ApiResponse(status: Response::HTTP_OK)]
    public function profile(#[CurrentUser()] ?User $user): UserResponseDTO
    {
        return UserResponseDTO::fromEntity($user);
    }
}
