<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\UserRepository;

class TestUserRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:user-repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the user repository methods';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userRepository = new UserRepository();

        $users = $userRepository->getAll();

        $this->info('Total users: ' . count($users));

        $user = $userRepository->getById('0651263b-2293-46b1-a592-b709d632a2f0');

        $this->info('User obtained by id: ' . json_encode($user));

        $user = $userRepository->getByEmail('andres52885241@gmail.com');

        $this->info('User obtained by email: ' . json_encode($user));

        $createdUser = $userRepository->create([
            'user_name' => 'Test',
            'user_lastname' => 'Test',
            'user_email' => 'test@test.com',
            'user_phone' => '1234567890',
            'user_address' => 'Test',
            'user_image' => 'Test',
            'user_password' => 'password',
            'role_id' => 1,
        ]);

        $this->info('User created: ' . json_encode($createdUser));

        $user = $userRepository->update($createdUser['user_id'], [
            'user_name' => 'Prueba',
            'user_lastname' => 'Prueba',
        ]);

        $this->info('User updated: ' . json_encode($user));

        $user = $userRepository->delete($createdUser['user_id']);

        $this->info('User deleted: ' . json_encode($user));
    }
}
