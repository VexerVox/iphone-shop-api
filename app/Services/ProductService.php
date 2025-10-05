<?php

namespace App\Services;

use App\Data\ProductIndexData;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    /**
     * @return LengthAwarePaginator|Collection<Product>
     */
    public function index(ProductIndexData $data): LengthAwarePaginator|Collection
    {
        $query = Product::query()
            ->where('is_available', true)
            ->with([
                'deviceModel',
                'color',
                'storageCapacity',
            ]);

        // Device models
        if (! empty($data->deviceModels)) {
            $query->whereHas('deviceModel', function ($query) use ($data) {
                $query->whereIn('slug', $data->deviceModels);
            });
        }

        // Colors
        if (! empty($data->colors)) {
            $query->whereHas('color', function ($query) use ($data) {
                $query->whereIn('slug', $data->colors);
            });
        }

        // Storages
        if (! empty($data->storageCapacities)) {
            $query->whereHas('storageCapacity', function ($query) use ($data) {
                $query->whereIn('slug', $data->storageCapacities);
            });
        }

        // Sim
        if (! is_null($data->hasEsim)) {
            $query->where('has_esim', $data->hasEsim);
        }

        if (! is_null($data->hasNanosim)) {
            $query->where('has_nanosim', $data->hasNanosim);
        }

        if (! is_null($data->hasDualsim)) {
            $query->where('has_dualsim', $data->hasDualsim);
        }

        // Price
        if (! is_null($data->minPrice)) {
            $query->where(function ($query) use ($data) {
                $query
                    ->where(function ($query) use ($data) {
                        $query
                            ->where('discounted_price', null)
                            ->where('price', '>=', $data->minPrice);
                    })
                    ->orWhere(function ($query) use ($data) {
                        $query
                            ->where('discounted_price', '!=', null)
                            ->where('discounted_price', '>=', $data->minPrice);
                    });
            });
        }

        if (! is_null($data->maxPrice)) {
            $query->where(function ($query) use ($data) {
                $query
                    ->where(function ($query) use ($data) {
                        $query
                            ->where('discounted_price', null)
                            ->where('price', '<=', $data->maxPrice);
                    })
                    ->orWhere(function ($query) use ($data) {
                        $query
                            ->where('discounted_price', '!=', null)
                            ->where('discounted_price', '<=', $data->maxPrice);
                    });
            });
        }

        return $query
            ->orderBy('id', 'desc')
            ->paginate(
                (new PaginationService)->getPerPage()
            );
    }

    public function show(Product $product): Product
    {
        $product->load([
            'deviceModel',
            'color',
            'storageCapacity',
        ]);

        return $product;
    }
}
