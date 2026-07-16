<?php

namespace App\Entity;

use App\Enum\CascadeEnum;
use App\Listener\Doctrine\LoyaltyAccountListener;
use App\Repository\LoyaltyAccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoyaltyAccountRepository::class)]
#[ORM\Table(name: 'loyalty_account')]
#[ORM\EntityListeners([LoyaltyAccountListener::class])]
class LoyaltyAccount extends AbstractEntity
{
    #[ORM\OneToOne(targetEntity: User::class, inversedBy: 'loyaltyAccount')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(options: ['default' => 0])]
    private int $balance = 0;

    #[ORM\OneToMany(
        targetEntity: LoyaltyTransaction::class,
        mappedBy: 'loyaltyAccount',
        cascade: [CascadeEnum::REMOVE->value]
    )]
    private Collection $loyaltyTransactions;

    public function __construct()
    {
        $this->loyaltyTransactions = new ArrayCollection();
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function setBalance(int $balance): static
    {
        $this->balance = $balance;

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
