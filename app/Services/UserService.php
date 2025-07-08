<?php

namespace App\Services;

use App\Contracts\Services\UserServiceInterface;
use App\Contracts\Repositories\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers(array $filters): array
    {
        return $this->userRepository->getAll($filters);
    }

    public function getUserById(string $id): array | null
    {
        return $this->userRepository->getById($id);
    }

    public function createUser(array $data): array
    {
        $created = $this->userRepository->create($data);

        if (!$created) {
            throw new \Exception('Error al crear el usuario');
        }

        return $this->getUserById($created['user_id']);
    }

    public function updateUser(string $id, array $data): array
    {
        $updated = $this->userRepository->update($id, [
            'user_name' => $data['user_name'],
            'user_lastname' => $data['user_lastname'],
            'user_email' => $data['user_email'],
            'user_phone' => $data['user_phone'],
            'user_address' => $data['user_address'],
            'user_image' => $data['user_image'],
            'role_id' => $data['role_id'],
        ]);

        if (!$updated) {
            throw new \Exception('Error al actualizar el usuario');
        }

        return $this->getUserById($id);
    }

    public function deleteUser(string $id): bool
    {
        return $this->userRepository->delete($id);
    }
}
