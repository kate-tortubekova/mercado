<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\UserRoleEnum;
use Symfony\Component\Clock\DatePoint;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'user')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(enumType: UserRoleEnum::class)]
    private UserRoleEnum $role;

    #[ORM\Column(type: 'date_point')]
    private ?DatePoint $createdAt = null;

    #[ORM\Column(type: 'date_point')]
    private ?DatePoint $updatedAt = null;

    #[ORM\Column(type: 'date_point', nullable: true)]
    private ?DatePoint $deletedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getRole(): UserRoleEnum
    {
        return $this->role;
    }

    public function setRole(UserRoleEnum $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getCreatedAt(): ?DatePoint
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = DatePoint::createFromInterface($createdAt);

        return $this;
    }

    public function getUpdatedAt(): ?DatePoint
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = DatePoint::createFromInterface($updatedAt);

        return $this;
    }

    public function getDeletedAt(): ?DatePoint
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): static
    {
        $this->deletedAt = $deletedAt ? DatePoint::createFromInterface($deletedAt) : null;

        return $this;
    }
}
