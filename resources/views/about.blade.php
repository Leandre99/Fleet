@extends('layouts.app')

@section('title', 'À Propos - Fleet Premium')

@section('content')
<!-- Hero Section -->
<section class="py-5 bg-dark text-white text-center" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('/luxury_office_bg.png'); background-size: cover; background-position: center; padding: 100px 0;">
    <div class="container" data-aos="fade-up">
        <h1 class="display-3 fw-bold mb-3">L'Excellence en <span class="text-success">Mouvement</span></h1>
        <p class="lead mb-0">Découvrez l'histoire et les valeurs qui font de Fleet Premium le leader du transport VIP.</p>
    </div>
</section>

<!-- Mission Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="section-title">Notre Vision</h2>
                <p class="lead mb-4">Depuis 2015, Fleet Premium s'efforce de transformer chaque déplacement en un moment d'exception.</p>
                <p class="text-muted mb-4">Ce qui a commencé comme un service local à Paris est devenu une référence internationale. Nous combinons technologie de pointe et service client traditionnel pour offrir une ponctualité sans faille et une discrétion absolue.</p>
                
                <div class="row g-4 mt-2">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-patch-check-fill text-success fs-1"></i>
                            </div>
                            <div class="ms-3">
                                <h4 class="fw-bold mb-0">Qualité</h4>
                                <small class="text-muted">Certifiée ISO 9001</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-globe2 text-success fs-1"></i>
                            </div>
                            <div class="ms-3">
                                <h4 class="fw-bold mb-0">Global</h4>
                                <small class="text-muted">Présent dans 15 pays</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left">
                <div class="position-relative">
                    <img src="pro_driver_suit_1777286895698.png" class="img-fluid rounded-4 shadow-lg" alt="Our Professionalism">
                    <div class="position-absolute bottom-0 end-0 bg-success text-white p-4 rounded-4 shadow m-4 d-none d-md-block">
                        <h2 class="fw-bold mb-0">10+</h2>
                        <p class="mb-0">Années d'expérience</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title d-inline-block">Nos Valeurs Fondamentales</h2>
            <p class="text-muted">L'ADN de Fleet Premium repose sur trois piliers inébranlables.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="card border-0 rounded-4 p-4 text-center h-100 shadow-sm hover-shadow transition">
                    <div class="mb-4">
                        <div class="bg-success-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-shield-lock text-success fs-1"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold">Sécurité Absolue</h4>
                    <p class="text-muted">Chaque chauffeur est soumis à des tests rigoureux et chaque véhicule est inspecté quotidiennement pour garantir votre tranquillité d'esprit.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="card border-0 rounded-4 p-4 text-center h-100 shadow-sm hover-shadow transition">
                    <div class="mb-4">
                        <div class="bg-success-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-clock-history text-success fs-1"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold">Ponctualité Garantie</h4>
                    <p class="text-muted">Le temps est votre ressource la plus précieuse. Nous arrivons toujours 5 minutes en avance pour éviter tout stress inutile.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="card border-0 rounded-4 p-4 text-center h-100 shadow-sm hover-shadow transition">
                    <div class="mb-4">
                        <div class="bg-success-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-gem text-success fs-1"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold">Service Discret</h4>
                    <p class="text-muted">Nos chauffeurs sont formés à l'étiquette VIP. Votre vie privée est respectée, que vous travailliez ou vous reposiez à bord.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 text-center" data-aos="fade-up">
    <div class="container py-5">
        <h2 class="fw-bold mb-4">Prêt à vivre l'expérience Fleet Premium ?</h2>
        <div class="d-flex gap-3 justify-content-center">
            <a href="/#booking" class="btn btn-primary-green btn-lg px-5">Réserver maintenant</a>
            <a href="/contact" class="btn btn-outline-dark btn-lg px-5">Nous contacter</a>
        </div>
    </div>
</section>

<style>
    .bg-success-light {
        background-color: rgba(46, 204, 113, 0.1);
    }
    .hover-shadow:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important;
    }
    .transition {
        transition: all 0.3s ease;
    }
</style>
@endsection
