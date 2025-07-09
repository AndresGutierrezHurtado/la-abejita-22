<?php

namespace App\Infraestructure\Auth;

use Illuminate\Support\Facades\Auth;

use App\Contracts\Services\AuthProviderInterface;
use App\Models\User;

class LaravelProvider implements AuthProviderInterface
{
    public function authenticate(array $data, bool $remember): array
    {
        $user = User::find($data['user_id']);

        Auth::login($user, $remember);

        return ['success' => true];
    }

    public function getUser(): ?array
    {
        $user = Auth::user();

        if (!$user) {
            return null;
        }

        $user = User::with('role')->find($user->user_id);

        return $user->toArray();
    }

    public function logout(): bool
    {
        Auth::logout();
        return true;
    }
}
