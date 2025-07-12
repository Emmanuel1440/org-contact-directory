<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
    DB::table('industries')->insertOrIgnore([
        [
            'name' => 'Technology',
            'description' => 'Companies in the IT, software, and electronics sectors',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'Finance',
            'description' => 'Banks, insurance companies, and financial services',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'Healthcare',
            'description' => 'Hospitals, clinics, and health product providers',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'Agriculture',
            'description' => 'Farming, agri-tech, and food processing organizations',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ],
    ]);


    }
}
