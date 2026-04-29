<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RideController;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::get('/', function () {
    return view('home');
});
Route::get('/services', function () { return view('services'); });
Route::get('/tarifs', function () { return view('pricing'); });
Route::get('/a-propos', function () { return view('about'); });
Route::get('/contact', function () { return view('contact'); });

// Tracking simulation (authenticated client)
Route::get('/tracking/{id}', function ($id) {
    $ride = \App\Models\Ride::with('driver')->findOrFail($id);
    return view('tracking', compact('ride'));
})->middleware('auth')->name('tracking');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    
    // Universal Dashboard Redirect
    Route::get('/dashboard', [RideController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Client Routes
    Route::post('/booking/estimate', [RideController::class, 'store'])->name('rides.store');
    Route::post('/rides/{id}/cancel', [RideController::class, 'cancel'])->name('rides.cancel');
    Route::post('/rides/{id}/rate', [RideController::class, 'rate'])->name('rides.rate');
    Route::post('/rides/{id}/pay', [RideController::class, 'simulatePayment'])->name('rides.pay');

    // Driver Routes
    Route::middleware('role:driver')->group(function () {
        Route::post('/rides/{id}/accept', [RideController::class, 'accept'])->name('rides.accept');
        Route::post('/rides/{id}/start', [RideController::class, 'start'])->name('rides.start');
        Route::post('/rides/{id}/complete', [RideController::class, 'complete'])->name('rides.complete');
        Route::post('/rides/{id}/confirm-payment', [RideController::class, 'confirmPayment'])->name('rides.confirm-payment');
    });

    // Admin Routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/drivers', [\App\Http\Controllers\AdminController::class, 'drivers'])->name('drivers');
        Route::get('/clients', [\App\Http\Controllers\AdminController::class, 'clients'])->name('clients');
        Route::get('/rides', [\App\Http\Controllers\AdminController::class, 'rides'])->name('rides');
        
        Route::post('/users/{id}/toggle-active', [\App\Http\Controllers\AdminController::class, 'toggleActive'])->name('users.toggle-active');
        Route::post('/users/{id}/approve', [\App\Http\Controllers\AdminController::class, 'approveDriver'])->name('users.approve');
        Route::post('/rides/{id}/cancel', [\App\Http\Controllers\AdminController::class, 'cancelRide'])->name('rides.cancel');
        Route::delete('/rides/{id}', [\App\Http\Controllers\AdminController::class, 'destroyRide'])->name('rides.destroy');
    });
});

require __DIR__.'/auth.php';
