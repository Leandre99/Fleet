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
        \App\Models\User::create([
            'name' => 'Admin Fleet',
            'email' => 'admin@fleet.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);

        // Driver
        \App\Models\User::create([
            'name' => 'Jean Chauffeur',
            'email' => 'driver@fleet.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'driver',
        ]);

        // Client
        \App\Models\User::create([
            'name' => 'Marc Client',
            'email' => 'client@fleet.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'client',
        ]);
    }
}
