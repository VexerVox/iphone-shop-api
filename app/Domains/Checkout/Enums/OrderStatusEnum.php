<?php

namespace App\Domains\Checkout\Enums;

use App\Domains\Common\Traits\EnumValuesTrait;

enum OrderStatusEnum: string
{
    use EnumValuesTrait;

    case PENDING = 'pending';
    case PAYED = 'payed';
    case PAYMENT_FAILED = 'payment_failed';
    case COMPLETED = 'completed';
}
