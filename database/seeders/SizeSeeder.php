<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sizes')->insert([
            ['size_id' => 1, 'size_name' => '4', 'size_type' => 'clothing'],
            ['size_id' => 2, 'size_name' => '6', 'size_type' => 'clothing'],
            ['size_id' => 3, 'size_name' => '8', 'size_type' => 'clothing'],
            ['size_id' => 4, 'size_name' => '10', 'size_type' => 'clothing'],
            ['size_id' => 5, 'size_name' => '12', 'size_type' => 'clothing'],
            ['size_id' => 6, 'size_name' => '14', 'size_type' => 'clothing'],
            ['size_id' => 7, 'size_name' => '16', 'size_type' => 'clothing'],
            ['size_id' => 30, 'size_name' => 'XS', 'size_type' => 'clothing'],
            ['size_id' => 31, 'size_name' => 'S', 'size_type' => 'clothing'],
            ['size_id' => 32, 'size_name' => 'M', 'size_type' => 'clothing'],
            ['size_id' => 33, 'size_name' => 'L', 'size_type' => 'clothing'],
            ['size_id' => 34, 'size_name' => 'XL', 'size_type' => 'clothing'],
        ]);
    }
}
