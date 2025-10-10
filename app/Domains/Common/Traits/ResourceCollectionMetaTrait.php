<?php

namespace App\Domains\Common\Traits;

/**
 * @method currentPage(): int
 * @method lastPage(): int
 * @method perPage(): int
 * @method total(): int
 */
trait ResourceCollectionMetaTrait
{
    /**
     * @return array<string, int>
     */
    protected function getMeta(): array
    {
        // LengthAwarePaginator
        return [
            'currentPage' => $this->currentPage(),
            'lastPage' => $this->lastPage(),
            'perPage' => $this->perPage(),
            'total' => $this->total(),
        ];
    }
}
