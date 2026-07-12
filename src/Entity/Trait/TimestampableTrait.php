<?php

namespace App\Entity\Trait;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Clock\DatePoint;

trait TimestampableTrait
{
    #[ORM\Column(type: 'date_point')]
    private ?DatePoint $createdAt = null;

    #[ORM\Column(type: 'date_point')]
    private ?DatePoint $updatedAt = null;

    public function getCreatedAt(): ?DatePoint
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): static
    {
        $this->createdAt = DatePoint::createFromInterface($createdAt);

        return $this;
    }

    public function getUpdatedAt(): ?DatePoint
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = DatePoint::createFromInterface($updatedAt);

        return $this;
    }
}