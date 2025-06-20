<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(): array
    {
        return User::with('role')->get()->toArray();
    }

    public function getById(string $id): array
    {
        return User::with('role')->find($id)->toArray();
    }

    public function getByEmail(string $email): array
    {
        return User::with('role')->where('user_email', $email)->first()->toArray();
    }

    public function create(array $data): array
    {
        $createdUser = User::create($data);
        $id = $createdUser->user_id;

        return $this->getById($id);
    }

    public function update(string $id, array $data): bool
    {
        return User::find($id)->update($data);
    }

    public function delete(string $id): bool
    {
        return User::find($id)->delete();
    }
}
