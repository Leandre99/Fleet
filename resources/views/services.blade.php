@extends('layouts.app')

@section('title', 'Nos Services - Fleet Premium')

@section('content')
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">Nos Services de <span class="text-success">Transport</span></h1>
            <p class="lead text-muted">Une gamme complète pour tous vos besoins de mobilité.</p>
        </div>

        <div class="row g-4">
            <!-- Airport Transfer -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div style="height: 200px; background: url('hero_luxury_car_dubai_1777286231783.png') center/cover;"></div>
                    <div class="card-body p-4">
                        <h4 class="fw-bold">Transferts Aéroport</h4>
                        <p class="text-muted">Accueil personnalisé aux aéroports (CDG, Orly, Dubaï DXB, Londres Heathrow). Gestion des bagages et suivi des vols.</p>
                        <a href="#booking" class="btn btn-link text-success p-0 fw-bold" style="text-decoration: none;">Réserver maintenant <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- City Rides -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div style="height: 200px; background: url('pro_driver_suit_1777286895698.png') center/cover;"></div>
                    <div class="card-body p-4">
                        <h4 class="fw-bold">Courses en Ville</h4>
                        <p class="text-muted">Déplacements rapides et confortables pour vos rendez-vous d'affaires ou sorties personnelles en centre-ville.</p>
                        <a href="#booking" class="btn btn-link text-success p-0 fw-bold" style="text-decoration: none;">Réserver maintenant <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Hourly Booking -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div style="height: 200px; background: url('vip_car_interior_1777286689994.png') center/cover;"></div>
                    <div class="card-body p-4">
                        <h4 class="fw-bold">Mise à Disposition</h4>
                        <p class="text-muted">Réservez un chauffeur pour quelques heures ou une journée entière. Flexibilité totale pour vos circuits.</p>
                        <a href="#booking" class="btn btn-link text-success p-0 fw-bold" style="text-decoration: none;">Réserver maintenant <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Long Distance -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="bg-success text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="bi bi-map" style="font-size: 4rem;"></i>
                    </div>
                    <div class="card-body p-4">
                        <h4 class="fw-bold">Longues Distances</h4>
                        <p class="text-muted">Voyages interurbains (ex: Paris-Lyon, Dubaï-Abu Dhabi) dans un confort absolu sans les contraintes du train.</p>
                        <a href="#booking" class="btn btn-link text-success p-0 fw-bold" style="text-decoration: none;">Réserver maintenant <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- VIP Services -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="bg-dark text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="bi bi-gem" style="font-size: 4rem; color: gold;"></i>
                    </div>
                    <div class="card-body p-4">
                        <h4 class="fw-bold">Services VIP</h4>
                        <p class="text-muted">Protection rapprochée, conciergerie et véhicules blindés sur demande pour une sécurité maximale.</p>
                        <a href="#booking" class="btn btn-link text-success p-0 fw-bold" style="text-decoration: none;">Réserver maintenant <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
