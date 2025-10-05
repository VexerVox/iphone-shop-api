<?php

namespace App\Services;

class PaginationService
{
    public const DEFAULT_LIMIT = 10;

    public const MAX_LIMIT = 100;

    public function getPerPage(?int $defaultLimit = null, ?int $maxLimit = null): int
    {
        $currentDefaultLimit = $defaultLimit ?? self::DEFAULT_LIMIT;
        $currentMaxLimit = $maxLimit ?? self::MAX_LIMIT;

        $validated = request()->validate([
            'perPage' => ['integer', 'min:1', 'max:'.$currentMaxLimit],
        ]);

        return (int) ($validated['perPage'] ?? $currentDefaultLimit);
    }
}
