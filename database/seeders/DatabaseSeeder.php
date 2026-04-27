<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Demo Users via the existing seeder
        $this->call(UserRoleSeeder::class);

        // 2. Create more Drivers
        User::factory(5)->create(['role' => 'driver']);

        // 3. Create more Clients
        User::factory(10)->create(['role' => 'client']);

        // 4. Create Rides
        \App\Models\Ride::factory(30)->create();
    }
}
