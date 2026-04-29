<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@fleet.com'],
            [
                'name' => 'Admin Fleet',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        // Driver
        \App\Models\User::updateOrCreate(
            ['email' => 'driver@fleet.com'],
            [
                'name' => 'Jean Chauffeur',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'driver',
                'is_active' => true,
                'is_approved' => true,
            ]
        );

        // Client
        \App\Models\User::updateOrCreate(
            ['email' => 'client@fleet.com'],
            [
                'name' => 'Marc Client',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'client',
                'is_active' => true,
            ]
        );
    }
}
