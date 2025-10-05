<?php

namespace App\Http\Requests\Product;

use App\Traits\RequestFailedTrait;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    use RequestFailedTrait;

    public function rules(): array
    {
        return [
            'deviceModels' => 'nullable|array',
            'deviceModels.*' => 'exists:device_models,slug',
            'colors' => 'nullable|array',
            'colors.*' => 'exists:product_colors,slug',
            'storageCapacities' => 'nullable|array',
            'storageCapacities.*' => 'exists:product_storage_capacities,slug',
            'minPrice' => 'nullable|numeric|min:0',
            'maxPrice' => 'nullable|numeric|min:0',
            'hasEsim' => 'nullable|boolean',
            'hasNanosim' => 'nullable|boolean',
            'hasDualsim' => 'nullable|boolean',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
