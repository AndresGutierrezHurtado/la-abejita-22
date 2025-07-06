<?php

namespace App\Contracts\Services;

interface AuthServiceInterface
{
    public function register(array $data): array;
    public function login(array $data): bool;
    public function logout(): bool;
    public function forgotPassword(string $email): bool;
    public function resetPassword(string $token, string $password): bool;
}
