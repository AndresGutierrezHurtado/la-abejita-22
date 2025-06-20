<?php

namespace App\Contracts;

interface SchoolRepositoryInterface
{
    public function getAll(): array;
    public function getById(string $id): array;
    public function create(array $data): array;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
}