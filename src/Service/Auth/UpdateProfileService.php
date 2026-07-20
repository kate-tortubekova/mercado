<?php

namespace App\Service\Auth;

use App\DTO\Request\Auth\UpdateProfileDTO;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UpdateProfileService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function run(User $user, UpdateProfileDTO $dto): ?User
    {
        if (!empty($dto->firstName) && $user->getFirstName() !== $dto->firstName) {
            $user->setFirstName($dto->firstName);
        }

        if (!empty($dto->lastName) && $user->getLastName() !== $dto->lastName) {
            $user->setLastName($dto->lastName);
        }

        $this->entityManager->flush();

        return $user;
    }
}
