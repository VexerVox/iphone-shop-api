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

            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'max:50'],

            'firstName' => ['required', 'string', 'max:100'],
            'lastName' => ['required', 'string', 'max:100'],
            'addressLine1' => ['required', 'string', 'max:255'],
            'addressLine2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'zipCode' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
