<?php

namespace App\DTO\Response;

use App\Entity\User;

final class UserResponseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $email,
        public readonly ?string $firstName,
        public readonly ?string $lastName,
    ) {}

    public static function fromEntity(User $user): self
    {
        return new self(
            id: $user->getId(),
            email: $user->getEmail(),
            firstName: $user->getFirstName(),
            lastName: $user->getLastName()
        );
    }
}
