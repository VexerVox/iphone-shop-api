<?php

namespace App\Domains\Checkout\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'products' => 'required|array',
            'products.*.slug' => 'required|exists:products,slug',
            'products.*.quantity' => 'required|integer|min:1|max:99',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
