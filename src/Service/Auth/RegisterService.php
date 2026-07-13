<?php

namespace App\Service\Auth;

use App\DTO\Request\Auth\RegisterDTO;
use App\Entity\User;
use App\Enum\UserRoleEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterService
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function run(RegisterDTO $dto): User
    {
        $user = new User();
        $user->setEmail($dto->email);
        $user->setFirstName($dto->first_name);
        $user->setLastName($dto->last_name);
        $user->setRole(UserRoleEnum::USER);
        
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $dto->password
        );

        $user->setPassword($hashedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}
