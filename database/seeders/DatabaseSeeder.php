<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed admin user first
        $this->call(AdminUserSeeder::class);
        
        // Seed distributors only
        $this->call(DistributorSeeder::class);
    }
}
