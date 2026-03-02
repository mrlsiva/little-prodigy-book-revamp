<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin user already exists
        $adminUser = User::where('username', 'admin')->first();

        if (!$adminUser) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@littleprodigybooks.com',
                'username' => 'admin',
                'password' => Hash::make('prodigy@2026'),
                'role' => 'admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]);

            $this->command->info('Admin user created successfully!');
            $this->command->info('Username: admin');
            $this->command->info('Password: prodigy@2026');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
