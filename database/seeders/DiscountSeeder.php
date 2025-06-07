<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('discounts')->insert([
            [
                'discount_id' => '5d403da8-ce12-45a7-ae5c-940557bfd100',
                'discount_code' => 'B1ENVEN1D0',
                'discount_type' => 'fixed',
                'discount_value' => 10000,
                'discount_min_purchase' => 50000,
                'discount_max_uses' => null,
                'discount_user_limit' => 1,
                'discount_start' => now(),
                'discount_end' => now()->addDays(30),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
