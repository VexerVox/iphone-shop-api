<?php

namespace App\Enums;

use App\Traits\EnumValuesTrait;

enum OrderStatusEnum: string
{
    use EnumValuesTrait;

    case CREATED = 'created';
    case PENDING = 'pending';
    case PAYED = 'payed';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
}
