<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Mock distance and price calculation
        $distance = rand(5, 50);
        $price = $distance * 1.5;

        $ride = Ride::create([
            'client_id' => Auth::id(),
            'pickup_address' => $request->pickup_address,
            'destination_address' => $request->destination_address,
            'distance_km' => $distance,
            'price' => $price,
            'status' => 'pending',
        ]);

        return redirect()->route('tracking', ['id' => $ride->id])->with('success', 'Recherche de chauffeur en cours...');
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

        // Ensure only the assigned driver can confirm payment
        if ($ride->driver_id !== Auth::id()) {
            abort(403);
        }

        $ride->update(['payment_status' => 'paid']);

        return back()->with('success', 'Paiement confirmé ! La course est désormais clôturée.');
    }
}
