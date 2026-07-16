<?php

namespace App\Listener\Doctrine;

use App\Entity\LoyaltyAccount;
use App\Entity\User;
use App\Enum\UserRoleEnum;
use Doctrine\ORM\Event\PrePersistEventArgs;

class UserListener
{
    public const WELCOME_BONUS_AMOUNT = 200;

    public function prePersist(User $user, PrePersistEventArgs $args): void
    {
        if ($user->getRole() === UserRoleEnum::USER) {
            $loyaltyAccount = new LoyaltyAccount();
            $loyaltyAccount->setBalance(self::WELCOME_BONUS_AMOUNT);

            $user->setLoyaltyAccount($loyaltyAccount);
        }
    }
}
