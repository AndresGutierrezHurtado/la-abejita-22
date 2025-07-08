<?php

namespace App\Infraestructure\Repositories\Eloquent;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(): array
    {
        return User::with('role')->get()->toArray();
    }

    public function getById(string $id): array | null
    {
        $user = User::with('role')->find($id);

        if (!$user) {
            return null;
        }

        return $user->toArray();
    }

    public function getByEmail(string $email, bool $withPassword = false): array | null
    {
        $user =  User::with('role')->where('user_email', $email)->first();

        if (!$user) {
            return null;
        }

        $userData = $user->toArray();

        if ($withPassword) {
            $userData['user_password'] = $user->user_password;
        }

        return $userData;
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
