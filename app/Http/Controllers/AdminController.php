<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ride;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * List all drivers.
     */
    public function drivers()
    {
        $drivers = User::where('role', 'driver')->latest()->paginate(15);
        return view('admin.drivers', compact('drivers'));
    }

    /**
     * List all clients.
     */
    public function clients()
    {
        $clients = User::where('role', 'client')->latest()->paginate(15);
        return view('admin.clients', compact('clients'));
    }

    /**
     * List all rides.
     */
    public function rides()
    {
        $rides = Ride::with(['client', 'driver'])->latest()->paginate(15);
        return view('admin.rides', compact('rides'));
    }

    /**
     * Toggle the active status of a user.
     */
    public function toggleActive($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent admin from deactivating themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas désactiver votre propre compte.');
        }

        $user->update([
            'is_active' => !$user->is_active,
        ]);

        $status = $user->is_active ? 'activé' : 'suspendu';
        return back()->with('success', "Le compte de {$user->name} a été {$status}.");
    }

    /**
     * Approve a driver.
     */
    public function approveDriver($id)
    {
        $user = User::where('role', 'driver')->findOrFail($id);
        
        $user->update([
            'is_approved' => true,
        ]);

        return back()->with('success', "Le chauffeur {$user->name} a été approuvé et peut désormais accepter des courses.");
    }

    /**
     * Manually cancel a ride.
     */
    public function cancelRide($id)
    {
        $ride = Ride::findOrFail($id);

        if (in_array($ride->status, ['completed', 'cancelled'])) {
            return back()->with('error', 'Cette course est déjà terminée ou annulée.');
        }

        $ride->update([
            'status' => 'cancelled',
        ]);

        return back()->with('success', 'La course a été annulée manuellement.');
    }

    /**
     * Delete a ride permanently.
     */
    public function destroyRide($id)
    {
        $ride = Ride::findOrFail($id);
        $ride->delete();

        return back()->with('success', 'La course a été supprimée définitivement.');
    }
}
