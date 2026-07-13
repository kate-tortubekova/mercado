<?php

namespace App\DTO\Request\Auth;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[Assert\Expression(
    "this.password === this.password_confirmation",
    message: "Passwords do not match."
)]
#[UniqueEntity(
    entityClass: User::class, 
    fields: ['email'], 
    message: 'This email is already registered.'
)]
class RegisterDTO
{
    public function __construct(
        #[Assert\NotBlank(message: 'Email is required.')]
        #[Assert\Email(message: 'Invalid email format.')]
        #[Assert\Length(max: 255, maxMessage: 'Email must not exceed 255 characters.')]
        public readonly string $email,

        #[Assert\NotBlank(message: 'Password is required.')]
        #[Assert\Length(
            min: 8,
            max: 255,
            minMessage: 'Password must be at least 8 characters long.',
            maxMessage: 'Password must not exceed 255 characters.'
        )]

        #[Assert\PasswordStrength(minScore: Assert\PasswordStrength::STRENGTH_MEDIUM, message: 'The password is too weak.')]
        public readonly string $password,

        #[Assert\NotBlank(message: 'Password confirmation is required.')]
        public readonly string $password_confirmation,

        #[Assert\Length(max: 255, maxMessage: 'First name must not exceed 255 characters.')]
        public readonly ?string $first_name,

        #[Assert\Length(max: 255, maxMessage: 'Last name must not exceed 255 characters.')]
        public readonly ?string $last_name,
    ) {}
}
