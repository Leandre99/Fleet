<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fleet Premium - Service de Chauffeur de Luxe')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-shield-check"></i> FLEET<span style="color: var(--accent-green)">PREMIUM</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="/services">Nos Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tarifs">Tarifs</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                    
                    @auth
                        <li class="nav-item ms-lg-3"><a class="nav-link fw-bold text-success" href="{{ route('dashboard') }}"><i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}</a></li>
                    @else
                        <li class="nav-item ms-lg-3"><a class="nav-link" href="{{ route('login') }}">Connexion</a></li>
                        <li class="nav-item"><a class="btn btn-outline-success btn-sm ms-2" href="{{ route('register') }}">S'inscrire</a></li>
                    @endauth

                    <li class="nav-item ms-lg-3">
                        <a href="/#booking" class="btn btn-primary-green">Réserver</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="container mt-4">
                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="container mt-4">
                <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4 mt-5">
        <div class="container text-center text-md-left">
            <div class="row text-center text-md-left">
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-success">Fleet Premium</h5>
                    <p>Votre partenaire de confiance pour vos déplacements de luxe en France, Dubaï et Londres.</p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-success">Services</h5>
                    <p><a href="/services" class="text-white" style="text-decoration: none;">Transfert Aéroport</a></p>
                    <p><a href="/services" class="text-white" style="text-decoration: none;">Course en Ville</a></p>
                    <p><a href="/services" class="text-white" style="text-decoration: none;">Service VIP</a></p>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-success">Contact</h5>
                    <p><i class="bi bi-geo-alt-fill me-2"></i> Paris, France / Dubaï, UAE</p>
                    <p><i class="bi bi-envelope-fill me-2"></i> contact@fleetpremium.com</p>
                    <p><i class="bi bi-whatsapp me-2"></i> +971 50 123 4567</p>
                </div>
            </div>
            <hr class="mb-4">
            <div class="row align-items-center text-center">
                <div class="col-12">
                    <p>© 2024 Tous droits réservés par: <strong class="text-success">Fleet Premium</strong></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
    @stack('scripts')
</body>
</html>
