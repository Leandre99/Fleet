<?php
  
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ride;
use App\Models\VehicleType;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Vehicle Types
        $standard = VehicleType::updateOrCreate(['name' => 'Berline Standard'], ['price_multiplier' => 1.0]);
        $business = VehicleType::updateOrCreate(['name' => 'Business Class'], ['price_multiplier' => 1.5]);
        $vip = VehicleType::updateOrCreate(['name' => 'First Class / VIP'], ['price_multiplier' => 2.5]);
        $van = VehicleType::updateOrCreate(['name' => 'Van Business'], ['price_multiplier' => 2.0]);

        // 2. Extra Drivers
        for ($i = 1; $i <= 5; $i++) {
            User::updateOrCreate(
                ['email' => "driver$i@fleet.com"],
                [
                    'name' => "Chauffeur $i",
                    'password' => Hash::make('password'),
                    'role' => 'driver',
                    'is_active' => true,
                    'is_approved' => true,
                ]
            );
        }

        // 3. Extra Clients
        for ($i = 1; $i <= 5; $i++) {
            User::updateOrCreate(
                ['email' => "client$i@fleet.com"],
                [
                    'name' => "Client $i",
                    'password' => Hash::make('password'),
                    'role' => 'client',
                    'is_active' => true,
                ]
            );
        }

        // 4. Fake Rides
        $drivers = User::where('role', 'driver')->get();
        $clients = User::where('role', 'client')->get();
        $types = VehicleType::all();

        foreach($clients as $client) {
            for($j = 0; $j < 3; $j++) {
                $status = ['completed', 'cancelled', 'pending'][rand(0, 2)];
                $driver = ($status !== 'pending') ? $drivers->random() : null;
                
                Ride::create([
                    'client_id' => $client->id,
                    'driver_id' => $driver ? $driver->id : null,
                    'vehicle_type_id' => $types->random()->id,
                    'pickup_address' => 'Aéroport CDG, Paris',
                    'destination_address' => 'Tour Eiffel, Paris',
                    'distance_km' => rand(20, 45),
                    'price' => rand(50, 150),
                    'status' => $status,
                    'payment_status' => ($status === 'completed') ? 'paid' : 'pending',
                    'payment_method' => rand(0, 1) ? 'card' : 'cash',
                    'rating' => ($status === 'completed') ? rand(4, 5) : null,
                    'comment' => ($status === 'completed') ? 'Excellent service' : null,
                ]);
            }
        }
    }
}
