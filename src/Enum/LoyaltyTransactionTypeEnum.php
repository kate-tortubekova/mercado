<?php

namespace App\Enum;

enum LoyaltyTransactionTypeEnum: string
{
    case EARN = 'EARN';
    case SPEND = 'SPEND';
    case REFUND = 'REFUND';
    case EXPIRED = 'EXPIRED';
}