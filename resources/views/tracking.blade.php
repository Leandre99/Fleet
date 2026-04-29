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
                        <h4 class="mb-3 text-white"><i class="bi bi-flag-fill me-2"></i>Course Terminée !</h4>
                        <p class="mb-4">Merci d'avoir voyagé avec <strong>Fleet Premium</strong>. Votre chauffeur a marqué la course comme terminée.</p>
                        <div class="bg-white text-dark p-4 rounded-4 shadow-sm mb-3">
                            <h5 class="fw-bold text-center mb-3">Votre avis nous intéresse</h5>
                            @if($ride->payment_status !== 'paid')
                            <form id="payment-form" action="{{ route('rides.rate', $ride->id) }}" method="POST">
                                @csrf
                                <div class="star-rating mb-3">
                                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Excellent"><i class="bi bi-star-fill"></i></label>
                                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Très bien"><i class="bi bi-star-fill"></i></label>
                                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Bien"><i class="bi bi-star-fill"></i></label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Passable"><i class="bi bi-star-fill"></i></label>
                                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Médiocre"><i class="bi bi-star-fill"></i></label>
                                </div>
                                <div class="mb-3 text-center">
                                    <label class="form-label d-block mb-2">Mode de paiement</label>
                                    <div class="btn-group w-100" role="group">
                                        <input type="radio" class="btn-check" name="payment_method" id="pay_card" value="card" checked autocomplete="off">
                                        <label class="btn btn-outline-success" for="pay_card"><i class="bi bi-credit-card me-2"></i>Carte</label>
                                        
                                        <input type="radio" class="btn-check" name="payment_method" id="pay_cash" value="cash" autocomplete="off">
                                        <label class="btn btn-outline-success" for="pay_cash"><i class="bi bi-cash-stack me-2"></i>Espèces</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <textarea name="comment" class="form-control border-0 bg-light" rows="3" placeholder="Un commentaire sur votre trajet ? (Optionnel)"></textarea>
                                </div>
                                <button type="submit" id="submit-btn" class="btn btn-primary-green w-100 py-3 fw-bold">
                                    <i class="bi bi-check-circle me-2"></i>VALIDER & NOTER
                                </button>
                            </form>
                            @else
                            <div class="text-center">
                                <i class="bi bi-{{ $ride->payment_status === 'paid' ? 'check-circle-fill text-success' : 'hourglass-split text-warning' }} fs-1 mb-3"></i>
                                <h6 class="fw-bold">{{ $ride->payment_status === 'paid' ? 'Paiement effectué' : 'Paiement en attente' }}</h6>
                                
                                @if($ride->payment_status === 'paid')
                                    <p class="text-muted small">Règlement par {{ $ride->payment_method === 'card' ? 'Carte' : 'Espèces' }}.</p>
                                    @if($ride->rating)
                                    <p class="mb-0">Note : <strong>{{ $ride->rating }}/5</strong> <i class="bi bi-star-fill text-warning"></i></p>
                                    @endif
                                @else
                                    <p class="text-muted small">Veuillez remettre <strong>{{ number_format($ride->price, 2) }} €</strong> en espèces au chauffeur. Il validera ensuite la course.</p>
                                @endif
                            </div>
                            @endif
                        </div>
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

                @if($ride->driver)
                <div class="card border-0 shadow-sm rounded-4 p-4 mt-4">
                    <h5>Chauffeur & Véhicule</h5>
                    <div class="d-flex align-items-center mt-3">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <i class="bi bi-person-fill text-success fs-3"></i>
                        </div>
                        <div>
                            <p class="fw-bold mb-0">{{ $ride->driver->name }}</p>
                            <p class="text-muted small mb-1">Mercedes Classe S (Noir) - AB-123-CD</p>
                            <div class="text-warning small">
                                <i class="bi bi-star-fill"></i> 4.9 (120 avis)
                            </div>
                        </div>
                    </div>
                    @if(in_array($ride->status, ['accepted', 'ongoing']))
                    <hr>
                    <a href="tel:+33600000000" class="btn btn-outline-success w-100"><i class="bi bi-telephone-fill me-2"></i>Appeler le chauffeur (+33 6 00 00 00 00)</a>
                    @endif
                </div>
                @endif
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
    var startPos = [{{ $ride->pickup_lat ?? 48.8566 }}, {{ $ride->pickup_lng ?? 2.3522 }}];
    var endPos = [{{ $ride->destination_lat ?? 48.8766 }}, {{ $ride->destination_lng ?? 2.3722 }}];
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

    document.getElementById('payment-form')?.addEventListener('submit', function(e) {
        if (document.getElementById('pay_card') && document.getElementById('pay_card').checked) {
            e.preventDefault();
            var btn = document.getElementById('submit-btn');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Traitement...';
            btn.disabled = true;
            setTimeout(() => {
                this.submit();
            }, 2000);
        }
    });
</script>
@endpush
