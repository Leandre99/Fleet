@extends('layouts.app')

@section('title', 'Tarifs - Fleet Premium')

@section('content')
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">Nos <span class="text-success">Tarifs</span></h1>
            <p class="lead text-muted">Une tarification transparente et compétitive, sans frais cachés.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive shadow-sm rounded-4">
                    <table class="table table-hover align-middle mb-0 bg-white">
                        <thead class="bg-light">
                            <tr>
                                <th class="p-4">Type de Véhicule</th>
                                <th class="p-4">Prix / km</th>
                                <th class="p-4">Prise en charge</th>
                                <th class="p-4">Attente / min</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-4">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-car-front text-success me-3 fs-3"></i>
                                        <div>
                                            <p class="fw-bold mb-0">Berline Standard</p>
                                            <small class="text-muted">Toyota Camry or similar</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">1.50 €</td>
                                <td class="p-4">5.00 €</td>
                                <td class="p-4">0.50 €</td>
                            </tr>
                            <tr>
                                <td class="p-4">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-briefcase text-success me-3 fs-3"></i>
                                        <div>
                                            <p class="fw-bold mb-0">Business Class</p>
                                            <small class="text-muted">Mercedes E-Class, BMW 5</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">2.50 €</td>
                                <td class="p-4">10.00 €</td>
                                <td class="p-4">0.80 €</td>
                            </tr>
                            <tr>
                                <td class="p-4">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-star-fill text-warning me-3 fs-3"></i>
                                        <div>
                                            <p class="fw-bold mb-0">First Class / VIP</p>
                                            <small class="text-muted">Mercedes S-Class, BMW 7</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">4.00 €</td>
                                <td class="p-4">20.00 €</td>
                                <td class="p-4">1.50 €</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row g-4 mt-5">
                    <div class="col-md-4">
                        <div class="card border-0 bg-light p-4 rounded-4">
                            <h5>Forfaits Aéroport</h5>
                            <p class="text-muted mb-0">Aéroport → Centre-ville à partir de <strong>45 €</strong></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 bg-light p-4 rounded-4">
                            <h5>Siège Bébé</h5>
                            <p class="text-muted mb-0">Disponible sur demande gratuitement.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 bg-light p-4 rounded-4">
                            <h5>Bagages Volumineux</h5>
                            <p class="text-muted mb-0">Van disponible pour les groupes (jusqu'à 7 pers).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
