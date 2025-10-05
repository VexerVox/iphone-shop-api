<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

trait CollectionMetaTrait
{
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
