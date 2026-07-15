<?php

namespace App\Entity;

use App\Entity\Trait\SoftDeletableTrait;
use App\Enum\CascadeEnum;
use App\Enum\UserRoleEnum;
use App\Listener\UserListener;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\EntityListeners([UserListener::class])]
class User extends AbstractEntity implements PasswordAuthenticatedUserInterface
{
    use SoftDeletableTrait;

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

    #[ORM\OneToOne(
        mappedBy: 'user',
        targetEntity: LoyaltyAccount::class,
        cascade: [CascadeEnum::PERSIST->value, CascadeEnum::REMOVE->value]
    )]
    private ?LoyaltyAccount $loyaltyAccount = null;

    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'user')]
    private Collection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
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

    public function getLoyaltyAccount(): ?LoyaltyAccount
    {
        return $this->loyaltyAccount;
    }

    public function setLoyaltyAccount(?LoyaltyAccount $loyaltyAccount): static
    {
        if ($loyaltyAccount !== null && $loyaltyAccount->getUser() !== $this) {
            $loyaltyAccount->setUser($this);
        }

        $this->loyaltyAccount = $loyaltyAccount;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }
}
