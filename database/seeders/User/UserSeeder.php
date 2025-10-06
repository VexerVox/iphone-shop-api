<?php

namespace Database\Seeders\User;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::upsert(
            $this->data(),
            ['id'],
            ['email', 'email_verified_at', 'password']
        );
    }

    private function data(): array
    {
        $now = now();

        return [
            [
                'id' => 1,
                'email' => 'test@gmail.com',
                'email_verified_at' => $now,
                'password' => Hash::make('11111111'),
            ],
            [
                'id' => 2,
                'email' => 'test2@gmail.com',
                'email_verified_at' => $now,
                'password' => Hash::make('11111111'),
            ],
            [
                'id' => 3,
                'email' => 'test3@gmail.com',
                'email_verified_at' => $now,
                'password' => Hash::make('11111111'),
            ],
        ];
    }
}
