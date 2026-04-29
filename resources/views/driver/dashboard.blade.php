@extends('layouts.app')

@section('title', 'Dashboard Chauffeur - Fleet Premium')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Espace <span class="text-success">Chauffeur</span></h2>
        <div class="badge bg-success p-2">Connecté en tant que: {{ Auth::user()->name }}</div>
    </div>

    @if($activeRide)
    <!-- Active Ride View -->
    <div class="row mb-5">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold mb-0">Course en cours</h4>
                        <span class="badge bg-primary fs-6">{{ ucfirst($activeRide->status) }}</span>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="text-muted small mb-1">DÉPART</p>
                            <p class="fw-bold fs-5">{{ $activeRide->pickup_address }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted small mb-1">DESTINATION</p>
                            <p class="fw-bold fs-5">{{ $activeRide->destination_address }}</p>
                        </div>
                    </div>

                    <div class="alert alert-light border-0 rounded-3 mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="d-block text-muted small">Client</span>
                                <strong>{{ $activeRide->client->name }}</strong>
                            </div>
                            <div>
                                <span class="d-block text-muted small text-end">Tarif</span>
                                <strong class="text-success fs-5">{{ number_format($activeRide->price, 2) }} €</strong>
                            </div>
                        </div>
                        <hr>
                        <a href="tel:+33600000000" class="btn btn-outline-secondary btn-sm w-100"><i class="bi bi-telephone-fill me-2"></i>Contacter le client (+33 6 00 00 00 00)</a>
                    </div>

                    <div class="d-flex gap-3">
                        @if($activeRide->status === 'accepted')
                        <form action="{{ route('rides.start', $activeRide->id) }}" method="POST" class="flex-grow-1">
                            @csrf
                            <button class="btn btn-primary btn-lg w-100 py-3 rounded-3">COMMENCER LA COURSE</button>
                        </form>
                        @elseif($activeRide->status === 'ongoing')
                        <form action="{{ route('rides.complete', $activeRide->id) }}" method="POST" class="flex-grow-1">
                            @csrf
                            <button class="btn btn-success btn-lg w-100 py-3 rounded-3">TERMINER LA COURSE</button>
                        </form>
                        @elseif($activeRide->status === 'completed')
                        <div class="alert alert-warning w-100 text-center mb-0">
                            <div class="spinner-border spinner-border-sm text-warning me-2" role="status"></div>
                            <strong>En attente du paiement...</strong>
                            <p class="mb-2 small mt-1">Le client doit régler {{ number_format($activeRide->price, 2) }} € en {{ $activeRide->payment_method === 'cash' ? 'espèces' : 'carte' }}.</p>
                            
                            @if($activeRide->payment_method === 'cash')
                            <form action="{{ route('rides.confirm-payment', $activeRide->id) }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm w-100 py-2 fw-bold">
                                    <i class="bi bi-cash-stack me-2"></i>CONFIRMER RÉCEPTION DES ESPÈCES
                                </button>
                            </form>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div id="map" style="height: 100%; min-height: 400px; border-radius: 20px;"></div>
            </div>
        </div>
    </div>
    @else
    <!-- Available Rides View -->
    <div class="row">
        <div class="col-lg-8">
            <h4 class="fw-bold mb-4">Courses Disponibles</h4>
            
            <div id="available-rides">
            
            @if(!$is_approved)
                <div class="card border-0 shadow-sm p-5 text-center rounded-4 border-warning border-start border-5">
                    <i class="bi bi-hourglass-split text-warning display-1 mb-3"></i>
                    <h5>Votre compte est en attente de validation</h5>
                    <p class="text-muted">Un administrateur doit approuver votre profil avant que vous ne puissiez recevoir et accepter des courses.</p>
                </div>
            @elseif($availableRides->isEmpty())
                <div class="card border-0 shadow-sm p-5 text-center rounded-4">
                    <i class="bi bi-search text-muted display-1 mb-3"></i>
                    <h5>Aucune course disponible pour le moment</h5>
                    <p class="text-muted">Revenez bientôt ou restez en ligne.</p>
                </div>
            @else
                @foreach($availableRides as $ride)
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden animate-up">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <p class="mb-1 text-muted small"><i class="bi bi-geo-alt-fill text-success me-2"></i>{{ $ride->pickup_address }}</p>
                                <p class="mb-0 text-muted small"><i class="bi bi-flag-fill text-danger me-2"></i>{{ $ride->destination_address }}</p>
                            </div>
                            <div class="col-md-2 text-center">
                                <p class="mb-0 fw-bold fs-5 text-success">{{ number_format($ride->price, 2) }} €</p>
                                <small class="text-muted">{{ $ride->distance_km }} km</small>
                            </div>
                            <div class="col-md-3 text-end">
                                <form action="{{ route('rides.accept', $ride->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-primary-green px-4 py-2 rounded-3">ACCEPTER</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-light mb-4 text-center">
                <h5 class="fw-bold mb-3">Statistiques du Jour</h5>
                <div class="row">
                    <div class="col-6 border-end">
                        <p class="text-muted small mb-1">Courses</p>
                        <h4 class="fw-bold mb-0 text-dark">{{ $completedRidesCount }}</h4>
                    </div>
                    <div class="col-6">
                        <p class="text-muted small mb-1">Gains</p>
                        <h4 class="fw-bold mb-0 text-success">{{ number_format($totalGains, 2) }} €</h4>
                    </div>
                </div>
            </div>
            <p class="text-muted small mt-2">Restez à proximité des zones à forte demande pour recevoir plus de courses.</p>
        </div>

            <div class="card border-0 shadow-sm p-4 rounded-4">
                <h5 class="fw-bold mb-3">Mon Compte</h5>
                <ul class="nav flex-column gap-2">
                    <li class="nav-item">
                        <a href="{{ route('profile.edit') }}" class="nav-link text-dark p-0"><i class="bi bi-person-gear me-2 text-success"></i>Modifier Profil</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link text-danger border-0 bg-transparent p-0 w-100 text-start"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    @if($activeRide)
    var startPos = [{{ $activeRide->pickup_lat ?? 48.8566 }}, {{ $activeRide->pickup_lng ?? 2.3522 }}];
    var map = L.map('map').setView(startPos, 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    L.marker(startPos).addTo(map).bindPopup('Position actuelle').openPopup();
    
    @if($activeRide->status === 'completed')
    // Polling to check if client paid
    setInterval(function() {
        fetch(window.location.href)
            .then(response => response.text())
            .then(html => {
                if (!html.includes('En attente du paiement')) {
                    window.location.reload();
                }
            });
    }, 2000);
    @endif
    @else
    // Polling to check for new missions when IDLE
    setInterval(function() {
        fetch(window.location.href)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newMissions = doc.getElementById('available-rides')?.innerHTML;
                const oldMissions = document.getElementById('available-rides');
                if (oldMissions && newMissions && newMissions !== oldMissions.innerHTML) {
                    window.location.reload();
                }
            });
    }, 2000);
    @endif
</script>
@endpush
