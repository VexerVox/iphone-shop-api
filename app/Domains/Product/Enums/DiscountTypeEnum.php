<?php

namespace App\Domains\Product\Enums;

use App\Domains\Common\Traits\EnumValuesTrait;

enum DiscountTypeEnum: string
{
    use EnumValuesTrait;

    case PERCENT = 'percent';
    case FIXED_AMOUNT = 'fixed-amount';
}
