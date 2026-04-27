@extends('layouts.app')

@section('title', 'Contact - Fleet Premium')

@section('content')
<section class="py-5 bg-light" id="contact">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">Contactez-<span class="text-success">nous</span></h1>
            <p class="text-muted">Une question ? Une demande spéciale ? Notre équipe est à votre écoute.</p>
        </div>

        <div class="row g-5">
            <div class="col-lg-6">
                <div class="bg-white p-5 rounded-4 shadow-sm animate-up">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nom complet</label>
                            <input type="text" class="form-control" placeholder="Jean Dupont">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="jean@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" rows="4" placeholder="Votre message..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary-green w-100">Envoyer le message</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex flex-column h-100 animate-up">
                    <div class="card border-0 mb-4 rounded-4 shadow-sm">
                        <div class="card-body p-4">
                            <h5>Informations de contact</h5>
                            <p class="mb-2"><i class="bi bi-telephone-fill text-success me-2"></i> +33 1 23 45 67 89</p>
                            <p class="mb-2"><i class="bi bi-whatsapp text-success me-2"></i> <a href="https://wa.me/971501234567" class="text-dark fw-bold" style="text-decoration: none;">Cliquez pour WhatsApp</a></p>
                            <p class="mb-0"><i class="bi bi-envelope-fill text-success me-2"></i> contact@fleetpremium.com</p>
                        </div>
                    </div>
                    <!-- Mock Map -->
                    <div class="flex-grow-1 rounded-4 overflow-hidden shadow-sm" style="min-height: 250px; background: #e0e0e0; display: flex; align-items: center; justify-content: center;">
                        <div class="text-center">
                            <i class="bi bi-geo-alt-fill text-danger fs-1"></i>
                            <p class="fw-bold mb-0">Siège Social - Paris</p>
                            <small class="text-muted">123 Avenue des Champs-Élysées</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
