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
                'user_address' => 'Dg. 68D #70C-31',
                'user_image' => 'https://avatars.githubusercontent.com/u/152313655?v=4',
                'user_password' => Hash::make('12345678'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 'fc5407e5-078d-40ca-8fdc-d684d51a466b',
                'user_name' => 'Alexandra',
                'user_lastname' => 'Hurtado Medina',
                'user_email' => 'alexandrahurtadomedina@gmail.com',
                'user_phone' => 3124852078,
                'user_address' => 'Dg. 68D #70C-31',
                'user_image' => 'https://static.vecteezy.com/system/resources/thumbnails/003/337/584/small/default-avatar-photo-placeholder-profile-icon-vector.jpg',
                'user_password' => Hash::make('12345678'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
