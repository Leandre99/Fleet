<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class RideController extends Controller
{
    /**
     * Display a listing of rides based on user role.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $rides = Ride::with(['client', 'driver'])->latest()->paginate(10);
            return view('admin.dashboard', compact('rides'));
        }

        if ($user->role === 'driver') {
            $is_approved = $user->is_approved;
            
            // Rides available to accept (only if approved)
            $availableRides = $is_approved ? Ride::where('status', 'pending')->latest()->get() : collect();
            
            // Stats for this driver
            $completedRidesCount = Ride::where('driver_id', $user->id)
                ->where('status', 'completed')
                ->where('payment_status', 'paid')
                ->count();
            
            $totalGains = Ride::where('driver_id', $user->id)
                ->where('status', 'completed')
                ->where('payment_status', 'paid')
                ->sum('price');
            // Active ride for this driver
            $activeRide = Ride::where('driver_id', $user->id)
                ->where(function($q) {
                    $q->whereIn('status', ['accepted', 'ongoing'])
                      ->orWhere(function($q2) {
                          $q2->where('status', 'completed')
                             ->where('payment_status', '!=', 'paid');
                      });
                })
                ->first();

            return view('driver.dashboard', compact('availableRides', 'activeRide', 'is_approved', 'completedRidesCount', 'totalGains'));
        }

        // For clients, show their history
        $rides = Ride::where('client_id', $user->id)->latest()->get();
        return view('dashboard', compact('rides'));
    }

    /**
     * Store a new ride request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pickup_address' => 'required|string',
            'destination_address' => 'required|string',
        ]);

        // Geocoding via OpenStreetMap (Nominatim)
        $pickup = $this->getCoordinates($request->pickup_address);
        $destination = $this->getCoordinates($request->destination_address);

        // Calculate real distance or fallback
        if ($pickup && $destination) {
            $distance = $this->calculateDistance($pickup['lat'], $pickup['lng'], $destination['lat'], $destination['lng']);
        } else {
            $distance = rand(5, 50);
        }
        
        $price = $distance * 1.5;

        $ride = Ride::create([
            'client_id' => Auth::id(),
            'pickup_address' => $request->pickup_address,
            'destination_address' => $request->destination_address,
            'pickup_lat' => $pickup['lat'] ?? null,
            'pickup_lng' => $pickup['lng'] ?? null,
            'destination_lat' => $destination['lat'] ?? null,
            'destination_lng' => $destination['lng'] ?? null,
            'distance_km' => $distance,
            'price' => $price,
            'status' => 'pending',
        ]);

        return redirect()->route('tracking', ['id' => $ride->id])->with('success', 'Recherche de chauffeur en cours...');
    }

    /**
     * Get coordinates from address via OSM Nominatim.
     */
    private function getCoordinates($address)
    {
        try {
            $response = Http::withHeaders(['User-Agent' => 'FleetPremiumApp'])
                ->get('https://nominatim.openstreetmap.org/search', [
                    'q' => $address,
                    'format' => 'json',
                    'limit' => 1
                ]);

            if ($response->successful() && count($response->json()) > 0) {
                return [
                    'lat' => (float) $response->json()[0]['lat'],
                    'lng' => (float) $response->json()[0]['lon']
                ];
            }
        } catch (\Exception $e) {}
        return null;
    }

    /**
     * Calculate distance between two points (Haversine).
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // km
        
        $latDelta = deg2rad($lat2 - $lat1);
        $lonDelta = deg2rad($lon2 - $lon1);
        
        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($lonDelta / 2) * sin($lonDelta / 2);
             
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        
        return round($earthRadius * $c, 2);
    }

    /**
     * Cancel a ride request.
     */
    public function cancel($id)
    {
        $ride = Ride::findOrFail($id);
        
        // Only allow cancellation if pending or accepted
        if (in_array($ride->status, ['pending', 'accepted'])) {
            $ride->update(['status' => 'cancelled']);
            return redirect()->route('dashboard')->with('success', 'Course annulée avec succès.');
        }

        return back()->with('error', 'Impossible d\'annuler une course déjà en cours.');
    }

    /**
     * Driver accepts a ride.
     */
    public function accept($id)
    {
        $ride = Ride::findOrFail($id);

        if ($ride->status !== 'pending') {
            return back()->with('error', 'Cette course n\'est plus disponible.');
        }

        $ride->update([
            'driver_id' => Auth::id(),
            'status' => 'accepted',
        ]);

        return back()->with('success', 'Vous avez accepté la course !');
    }

    /**
     * Driver starts the ride.
     */
    public function start($id)
    {
        $ride = Ride::findOrFail($id);
        $ride->update(['status' => 'ongoing']);
        return back()->with('success', 'La course a commencé.');
    }

    /**
     * Driver completes the ride.
     */
    public function complete($id)
    {
        $ride = Ride::findOrFail($id);
        $ride->update(['status' => 'completed']);
        return back()->with('success', 'Course terminée. Paiement en attente.');
    }
    /**
     * Client rates the ride and completes payment.
     */
    public function rate(Request $request, $id)
    {
        $ride = Ride::findOrFail($id);

        // Ensure only the client of this ride can rate it
        if ($ride->client_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
            'payment_method' => 'required|string|in:card,cash',
        ]);

        $ride->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_method === 'card' ? 'paid' : 'pending', 
        ]);

        return redirect()->route('dashboard')->with('success', 'Merci pour votre retour ! ' . ($request->payment_method === 'card' ? 'Votre paiement a été traité avec succès.' : 'Veuillez remettre le paiement en espèces au chauffeur.'));
    }

    /**
     * Driver confirms receipt of cash payment.
     */
    public function confirmPayment($id)
    {
        $ride = Ride::findOrFail($id);
        
        // Only driver of this ride can confirm cash payment
        if ($ride->driver_id !== Auth::id()) {
            abort(403);
        }

        $ride->update(['payment_status' => 'paid']);

        return back()->with('success', 'Paiement confirmé ! La course est maintenant totalement clôturée.');
    }

    public function simulatePayment($id)
    {
        $ride = Ride::findOrFail($id);

        if ($ride->payment_method !== 'card') {
            return back()->with('error', 'Seuls les paiements par carte peuvent être simulés ici.');
        }

        $ride->update(['payment_status' => 'paid']);

        return back()->with('success', 'Paiement par carte réussi (Simulation) !');
    }
}
