<?php

namespace App\Entity;

use App\Enum\LoyaltyTransactionTypeEnum;
use App\Repository\LoyaltyTransactionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoyaltyTransactionRepository::class)]
#[ORM\Table(name: 'loyalty_transaction')]
class LoyaltyTransaction extends AbstractEntity
{
    #[ORM\ManyToOne(targetEntity: LoyaltyAccount::class, inversedBy: 'loyaltyTransactions')]
    #[ORM\JoinColumn(nullable: false)]
    private LoyaltyAccount $loyaltyAccount;

    #[ORM\Column(enumType: LoyaltyTransactionTypeEnum::class)]
    private LoyaltyTransactionTypeEnum $type;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\Column]
    private ?int $balanceAfterTransaction = null;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'loyaltyTransactions')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Order $order = null;

    public function getLoyaltyAccount(): LoyaltyAccount
    {
        return $this->loyaltyAccount;
    }
    
    public function setLoyaltyAccount(LoyaltyAccount $loyaltyAccount): static
    {
        $this->loyaltyAccount = $loyaltyAccount;

        return $this;
    }

    public function getType(): LoyaltyTransactionTypeEnum
    {
        return $this->type;
    }

    public function setType(LoyaltyTransactionTypeEnum $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function getBalanceAfterTransaction(): ?int
    {
        return $this->balanceAfterTransaction;
    }

    public function setBalanceAfterTransaction(int $balanceAfterTransaction): static
    {
        $this->balanceAfterTransaction = $balanceAfterTransaction;

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): static
    {
        $this->order = $order;

        return $this;
    }
}
