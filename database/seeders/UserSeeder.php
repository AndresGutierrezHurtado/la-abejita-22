<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'user_id' => '0651263b-2293-46b1-a592-b709d632a2f0',
                'user_name' => 'Andrés',
                'user_lastname' => 'Gutiérrez Hurtado',
                'user_email' => 'andres52885241@gmail.com',
                'user_phone' => 3209202177,
                'user_address' => 'Dg. 68d #70c-31, Bogotá',
                'user_image' => 'https://avatars.githubusercontent.com/u/152313655?v=4',
                'user_password' => Hash::make('12345678'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'user_id' => 'fc5407e5-078d-40ca-8fdc-d684d51a466b',
                'user_name' => 'Alexandra',
                'user_lastname' => 'Hurtado Medina',
                'user_email' => 'alexandrahurtadomedina@gmail.com',
                'user_phone' => 3124852078,
                'user_address' => 'Dg. 68d #70c-31, Bogotá',
                'user_image' => 'https://hwchamber.co.uk/wp-content/uploads/2022/04/avatar-placeholder.gif',
                'user_password' => Hash::make('12345678'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'user_id' => '45b6f5e9-24b1-4349-95b9-c9dce79e9ff1',
                'user_name' => 'Wendy Alejandra',
                'user_lastname' => 'Navarro Arias',
                'user_email' => 'nwendy798@gmail.com',
                'user_phone' => 3044462452,
                'user_address' => 'Dg. 69 Sur #68-20, Bogotá',
                'user_image' => 'https://hwchamber.co.uk/wp-content/uploads/2022/04/avatar-placeholder.gif',
                'user_password' => Hash::make('12345678'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        ]);
    }
}
