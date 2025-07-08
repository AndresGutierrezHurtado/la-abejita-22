<?php

namespace App\Contracts\Services;

interface UserServiceInterface
{
    public function getUsers(array $filters): array;
    public function getUserById(string $id): array | null;
    public function createUser(array $data): array;
    public function updateUser(string $id, array $data): array;
    public function deleteUser(string $id): bool;
}