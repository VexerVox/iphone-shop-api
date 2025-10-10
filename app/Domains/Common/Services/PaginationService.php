<?php

namespace App\Domains\Common\Services;

class PaginationService
{
    public const DEFAULT_LIMIT = 10;

    public const MAX_LIMIT = 100;

    public static function getPerPage(
        int $defaultLimit = self::DEFAULT_LIMIT,
        int $maxLimit = self::MAX_LIMIT
    ): int {
        $validated = request()->validate([
            'perPage' => ['integer', 'min:1', "max:$maxLimit"],
        ]);

        return (int) ($validated['perPage'] ?? $defaultLimit);
    }
}
