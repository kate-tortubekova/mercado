<?php

namespace App\Entity\Trait;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Clock\DatePoint;

trait SoftDeletableTrait
{
    #[ORM\Column(type: 'date_point', nullable: true)]
    private ?DatePoint $deletedAt = null;

    public function getDeletedAt(): ?DatePoint
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?DateTimeInterface $deletedAt): static
    {
        $this->deletedAt = $deletedAt ? DatePoint::createFromInterface($deletedAt) : null;

        return $this;
    }
}
