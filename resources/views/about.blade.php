@extends('layouts.app')

@section('title', 'À Propos - Fleet Premium')

@section('content')
<!-- About Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Notre <span class="text-success">Histoire</span></h1>
                <p class="lead">Fondée avec la vision de redéfinir le transport de luxe, Fleet Premium opère aujourd'hui dans les plus grandes métropoles mondiales.</p>
                <p class="text-muted">Nous croyons que chaque trajet doit être une expérience en soi. Sécurité, ponctualité et confort sont les piliers de notre engagement envers nos clients.</p>
                <div class="row mt-4">
                    <div class="col-6">
                        <h2 class="fw-bold text-success">500+</h2>
                        <p class="text-muted">Véhicules</p>
                    </div>
                    <div class="col-6">
                        <h2 class="fw-bold text-success">10k+</h2>
                        <p class="text-muted">Clients satisfaits</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="pro_driver_suit_1777286895698.png" class="img-fluid rounded-4 shadow" alt="Our Team">
            </div>
        </div>

        <div class="row mt-5 text-center">
            <div class="col-md-4">
                <i class="bi bi-shield-check text-success display-4 mb-3"></i>
                <h5>Sécurité</h5>
                <p class="text-muted">Protocoles de sécurité rigoureux et véhicules entretenus.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-clock text-success display-4 mb-3"></i>
                <h5>Ponctualité</h5>
                <p class="text-muted">Respect strict des horaires pour vos rendez-vous.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-stars text-success display-4 mb-3"></i>
                <h5>Confort</h5>
                <p class="text-muted">Une flotte de véhicules premium pour un trajet relaxant.</p>
            </div>
        </div>
    </div>
</section>
@endsection
