@extends('layouts.app')

@section('title', 'Connexion - Fleet Premium')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 p-5 animate-up">
                <div class="text-center mb-4">
                    <h2 class="fw-bold">Bon retour <span class="text-success">parmi nous</span></h2>
                    <p class="text-muted">Connectez-vous pour gérer vos courses.</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control bg-light border-0 py-2" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control bg-light border-0 py-2" required>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label text-muted small" for="remember">
                            Se souvenir de moi
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary-green w-100 py-3 rounded-3 mb-3">CONNEXION</button>
                    
                    <div class="text-center">
                        <p class="small text-muted mb-0">Pas encore de compte ? <a href="{{ route('register') }}" class="text-success fw-bold">S'inscrire</a></p>
                    </div>
                </form>
            </div>

            <!-- Credentials Hint for Demo -->
            <div class="mt-4 p-3 bg-light rounded-3 text-center small">
                <p class="mb-1"><strong>Démos:</strong></p>
                <p class="mb-0">Admin: <code>admin@fleet.com</code> / <code>password</code></p>
                <p class="mb-0">Chauffeur: <code>driver@fleet.com</code> / <code>password</code></p>
                <p class="mb-0">Client: <code>client@fleet.com</code> / <code>password</code></p>
            </div>
        </div>
    </div>
</div>
@endsection
