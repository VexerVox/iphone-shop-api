<?php

namespace App\Domains\Auth\Http\Requests;

use App\Domains\Common\Traits\RequestFailedTrait;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    use RequestFailedTrait;

    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:255',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
