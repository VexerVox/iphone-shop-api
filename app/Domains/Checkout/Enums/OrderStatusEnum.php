<?php

namespace App\Domains\Checkout\Enums;

use App\Domains\Common\Traits\EnumToArrayTrait;

enum OrderStatusEnum: string
{
    use EnumToArrayTrait;

    case PENDING = 'pending';
    case PAYED = 'payed';
    case PAYMENT_FAILED = 'payment_failed';
    case COMPLETED = 'completed';
}
