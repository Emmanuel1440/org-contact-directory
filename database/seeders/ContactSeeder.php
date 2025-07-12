<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
            [
                'organization_id' => 1, // Nairobi Tech Solutions
                'first_name' => 'Alice',
                'last_name' => 'Wanjiru',
                'job_title' => 'CTO',
                'department' => 'Technology',
                'is_primary_contact' => true,
                'notes' => 'Handles all tech decisions.',
                'email' => 'alice@nairobitech.co.ke',
                'office_phone_number' => '020-1234567',
                'mobile_phone_number' => '+254712345678',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'organization_id' => 2, // GreenGrow Agriculture Ltd
                'first_name' => 'James',
                'last_name' => 'Otieno',
                'job_title' => 'Marketing Head',
                'department' => 'Marketing',
                'is_primary_contact' => true,
                'notes' => 'Key contact for public relations.',
                'email' => 'james@greengrow.co.ke',
                'office_phone_number' => '020-9876543',
                'mobile_phone_number' => '+254798765432',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    
}
