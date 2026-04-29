@extends('layouts.app')

@section('title', 'Mon Compte - Fleet Premium')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="text-center mb-4">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-person-fill fs-1 text-success"></i>
                    </div>
                    <h4 class="fw-bold mb-0">{{ Auth::user()->name }}</h4>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                </div>
                <hr>
                <ul class="nav flex-column gap-2">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link text-success fw-bold"><i class="bi bi-car-front me-2"></i>Mes Courses</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profile.edit') }}" class="nav-link text-dark"><i class="bi bi-gear me-2"></i>Paramètres</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-8">
            <h4 class="fw-bold mb-4">Mes Courses</h4>
            
            @if($rides->isEmpty())
                <div class="card border-0 shadow-sm p-5 text-center rounded-4">
                    <i class="bi bi-journal-x text-muted display-1 mb-3"></i>
                    <h5>Vous n'avez pas encore effectué de courses</h5>
                    <p class="text-muted">Réservez votre premier trajet dès maintenant !</p>
                    <a href="/" class="btn btn-primary-green d-inline-block mx-auto">Commander un véhicule</a>
                </div>
            @else
                @foreach($rides as $ride)
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden animate-up">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <p class="mb-1 fw-bold">#{{ $ride->id }} - {{ $ride->status === 'completed' ? 'Terminée' : ($ride->status === 'cancelled' ? 'Annulée' : 'En cours') }}</p>
                                <p class="mb-0 text-muted small"><i class="bi bi-geo-alt text-success me-1"></i>{{ $ride->pickup_address }}</p>
                                <p class="mb-0 text-muted small"><i class="bi bi-flag text-danger me-1"></i>{{ $ride->destination_address }}</p>
                                @if($ride->rating)
                                    <div class="mt-2 text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= $ride->rating ? '-fill' : '' }}"></i>
                                        @endfor
                                    </div>
                                @endif
                                @if($ride->payment_method)
                                    <p class="mt-2 mb-0 small text-muted">
                                        <i class="bi bi-{{ $ride->payment_method === 'card' ? 'credit-card' : 'cash-stack' }} me-1"></i>
                                        Paiement par {{ $ride->payment_method === 'card' ? 'Carte' : 'Espèces' }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-3 text-center">
                                <p class="mb-0 fw-bold text-success">{{ number_format($ride->price, 2) }} €</p>
                                <small class="text-muted">{{ $ride->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <div class="col-md-3 text-end">
                                <a href="{{ route('tracking', ['id' => $ride->id]) }}" class="btn btn-outline-success btn-sm">Détails</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
