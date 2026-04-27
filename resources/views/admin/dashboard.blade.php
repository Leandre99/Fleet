@extends('layouts.admin')

@section('title', 'Dashboard Admin - Fleet Premium')
@section('page_title', 'Tableau de Bord Global')

@section('content')
<div class="p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Tableau de Bord <span class="text-success">Admin</span></h2>
        <div class="badge bg-success p-2">Session Administrateur</div>
    </div>

    <!-- Stats Row -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-primary text-white">
                <h6>Courses Totales</h6>
                <h2 class="fw-bold mb-0">{{ \App\Models\Ride::count() }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-success text-white">
                <h6>Revenus Estimés</h6>
                <h2 class="fw-bold mb-0">{{ number_format(\App\Models\Ride::where('status', 'completed')->sum('price'), 2) }} €</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white text-dark">
                <h6>Chauffeurs Actifs</h6>
                <h2 class="fw-bold mb-0">{{ \App\Models\User::where('role', 'driver')->count() }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-warning text-dark">
                <h6>Courses en attente</h6>
                <h2 class="fw-bold mb-0">{{ \App\Models\Ride::where('status', 'pending')->count() }}</h2>
            </div>
        </div>
    </div>

    <!-- Rides Table -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white p-4">
            <h5 class="mb-0">Dernières Courses</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="p-4">ID</th>
                        <th class="p-4">Client</th>
                        <th class="p-4">Chauffeur</th>
                        <th class="p-4">Départ / Arrivée</th>
                        <th class="p-4">Tarif</th>
                        <th class="p-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rides as $ride)
                    <tr>
                        <td class="p-4">#{{ $ride->id }}</td>
                        <td class="p-4 fw-bold">{{ $ride->client->name }}</td>
                        <td class="p-4 text-muted">{{ $ride->driver ? $ride->driver->name : 'Non assigné' }}</td>
                        <td class="p-4">
                            <small class="d-block text-truncate" style="max-width: 150px;">{{ $ride->pickup_address }}</small>
                            <i class="bi bi-arrow-down text-success small"></i>
                            <small class="d-block text-truncate" style="max-width: 150px;">{{ $ride->destination_address }}</small>
                        </td>
                        <td class="p-4 fw-bold text-success">{{ number_format($ride->price, 2) }} €</td>
                        <td class="p-4">
                            @if($ride->status === 'pending')
                                <span class="badge bg-warning text-dark">En attente</span>
                            @elseif($ride->status === 'accepted')
                                <span class="badge bg-info text-white">Accepté</span>
                            @elseif($ride->status === 'ongoing')
                                <span class="badge bg-primary">En cours</span>
                            @elseif($ride->status === 'completed')
                                <span class="badge bg-success">Terminé</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $rides->links() }}
        </div>
    </div>
</div>
@endsection
