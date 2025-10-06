<?php

namespace App\Domains\Auth\Data;

use Spatie\LaravelData\Data;

class AuthData extends Data
{
    public function __construct(
        public string $email,
        public string $authToken,
    ) {}
}
