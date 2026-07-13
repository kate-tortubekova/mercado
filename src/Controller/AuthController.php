<?php

namespace App\Controller;

use App\DTO\Request\Auth\RegisterDTO;
use App\DTO\Response\UserResponseDTO;
use App\Service\Auth\RegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AuthController extends AbstractController
{
    #[Route('/api/register', name: 'register', methods: ['POST'])]
    public function register(
        #[MapRequestPayload] RegisterDTO $dto,
        RegisterService $registerService
    ): JsonResponse {
        $user = $registerService->run($dto);

        return $this->json(UserResponseDTO::fromEntity($user), Response::HTTP_CREATED);
    }
}
