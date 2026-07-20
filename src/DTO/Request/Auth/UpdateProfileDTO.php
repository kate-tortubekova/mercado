<?php

namespace App\DTO\Request\Auth;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateProfileDTO
{
    #[Assert\Length(min: 2, max: 255)]
    public ?string $firstName = null;

    #[Assert\Length(min: 2, max: 255)]
    public ?string $lastName = null;
}
