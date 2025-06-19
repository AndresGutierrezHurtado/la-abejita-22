<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schools')->insert([
            [
                'school_id' => 'c04e94b6-be87-4951-860d-82de26ddf21c',
                'school_name' => 'Colegio Angela Restrepo Moreno IED',
                'school_nit' => '111001800571',
                'school_address' => 'CL 69 SUR #71G - 12',
                'school_image' => 'https://redacademica.edu.co/sites/default/files/2022-11/WhatsApp%20Image%202022-09-26%20at%206.01.30%20AM.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
