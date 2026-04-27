@extends('layouts.app')

@section('title', 'Accueil - Fleet Premium')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-up">
                <h1 class="display-3 fw-bold mb-4">Voyagez avec <span style="color: var(--accent-green)">Élégance</span> et Confort.</h1>
                <p class="lead mb-5">Service de chauffeur privé haut de gamme à Paris, Londres et Dubaï. Disponibilité 24/7 pour tous vos besoins.</p>
                <div class="d-flex gap-3">
                    <a href="#services" class="btn btn-outline-light btn-lg px-4">Nos Services</a>
                    <a href="https://wa.me/971501234567" class="btn btn-success btn-lg px-4"><i class="bi bi-whatsapp me-2"></i>WhatsApp</a>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 mt-5 mt-lg-0" id="booking" data-aos="fade-left">
                <div class="booking-card">
                    <h3 class="fw-bold mb-4">Réservez votre trajet</h3>
                    <form action="{{ route('rides.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Lieu de départ</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-geo-alt"></i></span>
                                <input type="text" name="pickup_address" class="form-control bg-light border-0" placeholder="Ex: Aéroport CDG, Paris" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lieu d'arrivée</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-flag"></i></span>
                                <input type="text" name="destination_address" class="form-control bg-light border-0" placeholder="Ex: Tour Eiffel, Paris" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control bg-light border-0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Heure</label>
                                <input type="time" class="form-control bg-light border-0">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Type de véhicule</label>
                            <select class="form-select bg-light border-0">
                                <option>Berline Standard</option>
                                <option>Business Class</option>
                                <option>First Class / VIP</option>
                                <option>Van Business</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary-green w-100 py-3">OBTENIR UN TARIF</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 my-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title d-inline-block">Pourquoi nous choisir ?</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-clock-history"></i></div>
                    <h4>Disponibilité 24/7</h4>
                    <p class="text-muted">Nos chauffeurs sont à votre disposition à toute heure du jour et de la nuit.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-person-badge"></i></div>
                    <h4>Chauffeurs Pro</h4>
                    <p class="text-muted">Des conducteurs expérimentés, discrets et polyglottes pour un service irréprochable.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-credit-card-2-back"></i></div>
                    <h4>Paiement Sécurisé</h4>
                    <p class="text-muted">Réglez vos courses en ligne ou à bord en toute sécurité (CB, Amex, Espèces).</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Promo Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="/luxury_car_interior_vip.png" class="img-fluid rounded-4 shadow" alt="VIP Interior">
            </div>
            <div class="col-lg-6 ps-lg-5 mt-4 mt-lg-0">
                <h2 class="fw-bold mb-4">Un service VIP sur mesure</h2>
                <p class="text-muted mb-4">Que ce soit pour un transfert aéroport, un événement spécial ou une mise à disposition à l'heure, nous adaptons nos services à vos exigences les plus strictes.</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Accueil personnalisé avec pancarte</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Rafraîchissements et Wi-Fi à bord</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Berlines de luxe dernière génération</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
