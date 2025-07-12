<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organizations')->insert([
            [
                'name' => 'Nairobi Tech Solutions',
                'description' => 'A fast-growing software development company.',
                'industry_id' => 1, // Technology
                'website' => 'https://nairobitech.co.ke',
                'logo_url' => null,
                'founded_date' => '2015-06-12',
                'tax_id' => 'P123456789T',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'GreenGrow Agriculture Ltd',
                'description' => 'Leading in sustainable agricultural practices.',
                'industry_id' => 4, // Agriculture
                'website' => 'https://greengrow.co.ke',
                'logo_url' => null,
                'founded_date' => '2012-03-08',
                'tax_id' => 'A987654321T',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    
}
