<?php

namespace App\Domains\Common\Traits;

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
