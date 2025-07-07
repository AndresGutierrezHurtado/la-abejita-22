<?php

namespace App\Contracts\Services;

interface AuthProviderInterface
{
    public function authenticate(array $data, bool $remember): array;
    public function getUser(): ?array;
    public function logout(): bool;
}