<?php

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Data\AuthData;
use App\Domains\Auth\Models\User;
use App\Domains\Auth\Notifications\ForgotPasswordNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthService
{
    const TOKEN_NAME = 'authToken';

    public function login(string $email, string $password): ?AuthData
    {
        $valid = Auth::guard('web')->attempt(['email' => $email, 'password' => $password]);

        if (! $valid) {
            return null;
        }

        return AuthData::from([
            'email' => $email,
            'authToken' => Auth::user()->createToken(self::TOKEN_NAME)->plainTextToken,
        ]);
    }

    public function register(string $email, string $password): AuthData
    {
        $user = User::create([
            'email' => $email,
            'password' => $password,
        ]);

        return AuthData::from([
            'email' => $email,
            'authToken' => $user->createToken(self::TOKEN_NAME)->plainTextToken,
        ]);
    }

    public function forgotPassword(string $email): void
    {
        $user = User::where('email', $email)->first();

        $newPassword = Str::random(12);

        $user->update([
            'password' => $newPassword,
        ]);

        $user->notify(new ForgotPasswordNotification($newPassword));
    }

    public function changePassword(string $password): void
    {
        Auth::user()->update([
            'password' => $password,
        ]);
    }
}
