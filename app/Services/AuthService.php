<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// Contracts
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\AuthServiceInterface;
use App\Contracts\Services\AuthProviderInterface;

class AuthService implements AuthServiceInterface
{
    protected $userRepository;
    protected $authProvider;

    public function __construct(UserRepositoryInterface $userRepository, AuthProviderInterface $authProvider)
    {
        $this->userRepository = $userRepository;
        $this->authProvider = $authProvider;
    }

    public function register(array $data): array
    {
        $existingUser = $this->userRepository->getByEmail($data['user_email']);

        if ($existingUser) {
            throw new \Exception('Ya existe un usuario con este correo electrónico', 400);
        }

        $user = $this->userRepository->create([
            'user_name' => $data['user_name'],
            'user_lastname' => $data['user_lastname'],
            'user_email' => $data['user_email'],
            'user_phone' => $data['user_phone'],
            'user_address' => $data['user_address'],
            'user_password' => $data['user_password'],
            'user_image' => 'https://hwchamber.co.uk/wp-content/uploads/2022/04/avatar-placeholder.gif',
            'role_id' => 1,
        ]);

        return $user;
    }

    public function login(array $data): bool
    {
        $user = $this->userRepository->getByEmail($data['user_email'], true);

        if (!$user) {
            throw new \Exception('Usuario no encontrado', 404);
        }

        if (!Hash::check($data['user_password'], $user['user_password'])) {
            throw new \Exception('Contraseña incorrecta', 401);
        }

        $response = $this->authProvider->authenticate($user, $data['user_remember']);

        if (!$response['success']) {
            throw new \Exception('Error al autenticar usuario', 500);
        }

        return true;
    }

    public function logout(): bool
    {
        Auth::logout();

        return true;
    }

    public function forgotPassword(string $email): bool
    {
        $user = $this->userRepository->getByEmail($email);

        if (!$user) {
            throw new \Exception('Usuario no encontrado', 404);
        }

        $token = Str::random(60);

        /**
         * TODO: Guardar el token en la base de datos
         * TODO: Enviar el token al usuario por correo electrónico
         */

        return true;
    }

    public function resetPassword(string $token, string $password): bool
    {
        /**
         * TODO: Verificar si el token es válido
         * TODO: Buscar el usuario por el token
         * TODO: Actualizar la contraseña del usuario
         */

        return true;
    }
}
