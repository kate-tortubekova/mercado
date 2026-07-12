<?php

namespace App\Entity;

use App\Entity\Trait\SoftDeletableTrait;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: 'order')]
class Order extends AbstractEntity
{
    use SoftDeletableTrait;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'orders')]
    private User $user;

    #[ORM\OneToMany(targetEntity: LoyaltyTransaction::class, mappedBy: 'order')]
    private Collection $loyaltyTransactions;

    public function __construct()
    {
        $this->loyaltyTransactions = new ArrayCollection();
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, LoyaltyTransaction>
     */
    public function getLoyaltyTransactions(): Collection
    {
        return $this->loyaltyTransactions;
    }
}
