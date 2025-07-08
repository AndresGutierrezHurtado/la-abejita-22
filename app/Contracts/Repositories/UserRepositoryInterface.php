<?php

namespace App\Contracts\Repositories;

interface UserRepositoryInterface
{
    public function getAll(): array;
    public function getById(string $id): array | null;
    public function getByEmail(string $email, bool $withPassword = false): array | null;
    public function create(array $data): array;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
}
