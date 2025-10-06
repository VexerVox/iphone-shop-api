<?php

namespace App\Domains\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => 'required|string|min:6|max:255',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
