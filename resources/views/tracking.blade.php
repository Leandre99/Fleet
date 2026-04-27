@extends('layouts.app')

@section('title', 'Suivi de votre course - Fleet Premium')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <!-- Status Card -->
                <div class="tracking-status animate-up shadow-lg" id="status-card">
                    @if($ride->status === 'pending')
                        <h4 class="mb-3"><i class="bi bi-search me-2"></i>Recherche de chauffeur...</h4>
                        <p class="mb-0">Nous envoyons votre demande aux chauffeurs les plus proches.</p>
                        <div class="d-flex align-items-center mt-3">
                            <div class="spinner-border text-light spinner-border-sm me-2" role="status"></div>
                            <span>Veuillez patienter...</span>
                        </div>
                    @elseif($ride->status === 'accepted')
                        <h4 class="mb-3"><i class="bi bi-check-circle-fill me-2"></i>Chauffeur trouvé !</h4>
                        <p class="mb-0"><strong>{{ $ride->driver->name }}</strong> arrive vers vous.</p>
                        <p class="mb-0 small text-light-50">Véhicule: Mercedes Classe S (Noir)</p>
                        <hr>
                        <div class="d-flex align-items-center mb-3">
                            <div class="spinner-grow text-light spinner-grow-sm me-2" role="status"></div>
                            <span>Arrivée prévue dans <strong id="eta">5</strong> min</span>
                        </div>
                    @elseif($ride->status === 'ongoing')
                        <h4 class="mb-3"><i class="bi bi-geo-alt-fill me-2"></i>Course en cours</h4>
                        <p class="mb-0">Vous êtes en route vers votre destination.</p>
                        <hr>
                        <p class="mb-0">Destination: <strong>{{ $ride->destination_address }}</strong></p>
                    @elseif($ride->status === 'completed')
                        <h4 class="mb-3 text-white"><i class="bi bi-flag-fill me-2"></i>Arrivé !</h4>
                        <p class="mb-0">Merci d'avoir voyagé avec Fleet Premium.</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-light mt-3">Voir ma facture</a>
                    @elseif($ride->status === 'cancelled')
                        <h4 class="mb-3 text-danger"><i class="bi bi-x-circle-fill me-2"></i>Annulée</h4>
                        <p class="mb-0">La course a été annulée.</p>
                        <a href="/" class="btn btn-light mt-3">Commander à nouveau</a>
                    @endif
                    
                    @if(in_array($ride->status, ['pending', 'accepted']))
                    <hr>
                    <form action="{{ route('rides.cancel', $ride->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment annuler cette course ?')">
                        @csrf
                        <button type="submit" class="btn btn-outline-light w-100">Annuler la course</button>
                    </form>
                    @endif
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 mt-4">
                    <h5>Détails du trajet</h5>
                    <p class="text-muted small mb-1">DÉPART</p>
                    <p class="fw-bold mb-3">{{ $ride->pickup_address }}</p>
                    <p class="text-muted small mb-1">ARRIVÉE</p>
                    <p class="fw-bold">{{ $ride->destination_address }}</p>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>Tarif:</span>
                        <span class="fw-bold text-success">{{ number_format($ride->price, 2) }} €</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div id="map" style="height: 500px; border-radius: 20px;" class="shadow"></div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    var rideStatus = "{{ $ride->status }}";
    var map = L.map('map').setView([48.8566, 2.3522], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // Animation if ongoing
    if (rideStatus === 'ongoing') {
        var carIcon = L.divIcon({
            className: 'custom-div-icon',
            html: "<div style='background-color: var(--primary-green); width: 20px; height: 20px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 10px rgba(0,0,0,0.5);'></div>",
            iconSize: [20, 20],
            iconAnchor: [10, 10]
        });
        var carMarker = L.marker(startPos, {icon: carIcon}).addTo(map);
        
        var currentStep = 0;
        var steps = 100;
        
        function animateTrip() {
            if (currentStep <= steps) {
                var lat = startPos[0] + (endPos[0] - startPos[0]) * (currentStep / steps);
                var lng = startPos[1] + (endPos[1] - startPos[1]) * (currentStep / steps);
                carMarker.setLatLng([lat, lng]);
                if (currentStep % 10 === 0) map.panTo([lat, lng]);
                currentStep++;
                setTimeout(animateTrip, 2000);
            }
        }
        animateTrip();
    }

    // Auto-refresh logic (Polling every 3 seconds)
    if (rideStatus === 'pending' || rideStatus === 'accepted' || rideStatus === 'ongoing') {
        setInterval(function() {
            fetch(window.location.href)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newStatusCard = doc.getElementById('status-card').innerHTML;
                    const oldStatusCard = document.getElementById('status-card');
                    
                    const newStatus = html.match(/rideStatus = "(.*)"/)[1];
                    if (newStatus !== rideStatus) {
                        window.location.reload(); // Reload if status changed
                    }
                });
        }, 3000);
    }
</script>
@endpush
