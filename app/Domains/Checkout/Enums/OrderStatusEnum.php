<?php

namespace App\Domains\Checkout\Enums;

use App\Domains\Common\Traits\EnumToArrayTrait;

enum OrderStatusEnum: string
{
    use EnumToArrayTrait;

    // New order (auto)
    case PENDING = 'pending';

    // Payment processing (auto)
    case PAYED = 'payed';
    case PAYMENT_FAILED = 'payment_failed';

    // To be delivered (manual)
    case IN_PROGRESS = 'in_progress';

    // Delivered and completed (manual)
    case COMPLETED = 'completed';
}
