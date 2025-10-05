<?php

namespace App\Enums;

use App\Traits\EnumValuesTrait;

enum DiscountTypeEnum: string
{
    use EnumValuesTrait;

    case PERCENT = 'percent';
    case FIXED_AMOUNT = 'fixed-amount';
}
