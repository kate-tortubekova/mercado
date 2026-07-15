<?php

namespace App\Listener;

use App\Entity\LoyaltyAccount;
use App\Entity\LoyaltyTransaction;
use App\Enum\LoyaltyTransactionTypeEnum;
use Doctrine\ORM\Event\PrePersistEventArgs;

class LoyaltyAccountListener
{
    public function prePersist(LoyaltyAccount $loyaltyAccount, PrePersistEventArgs $args): void
    {
        if (empty($loyaltyAccount->getBalance())) {
            return;
        }

        $loyaltyTransaction = new LoyaltyTransaction();
        $loyaltyTransaction->setLoyaltyAccount($loyaltyAccount);
        $loyaltyTransaction->setType(LoyaltyTransactionTypeEnum::EARN);
        $loyaltyTransaction->setPoints($loyaltyAccount->getBalance());
        $loyaltyTransaction->setBalanceAfterTransaction($loyaltyAccount->getBalance());

        $em = $args->getObjectManager();
        $em->persist($loyaltyTransaction);
    }
}
