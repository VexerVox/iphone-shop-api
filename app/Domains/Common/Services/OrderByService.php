<?php

namespace App\Domains\Common\Services;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Validation\Rule;

class OrderByService
{
    public const DEFAULT_ORDER = 'desc';

    public const DEFAULT_COLUMN = 'id';

    private QueryBuilder|EloquentBuilder $query;

    private string $defaultColumn;

    private string $defaultOrder;

    public function __construct(QueryBuilder|EloquentBuilder $query)
    {
        $this->query = $query;

        $this->defaultColumn = self::DEFAULT_COLUMN;
        $this->defaultOrder = self::DEFAULT_ORDER;
    }

    public static function query(QueryBuilder|EloquentBuilder $query): static
    {
        return new static($query);
    }

    public function default(
        string $defaultColumn = self::DEFAULT_COLUMN,
        string $defaultOrder = self::DEFAULT_ORDER,
    ): static {
        $this->defaultColumn = $defaultColumn;
        $this->defaultOrder = $defaultOrder;

        return $this;
    }

    public function orderableBy(array $columns = []): QueryBuilder|EloquentBuilder
    {
        $validated = request()->validate([
            'orderBy' => [Rule::in($columns)],
            'direction' => [Rule::in(['asc', 'desc'])],
        ]);

        return $this->query
            ->orderBy(
                $validated['orderBy'] ?? $this->defaultColumn,
                $validated['direction'] ?? $this->defaultOrder,
            );
    }
}
