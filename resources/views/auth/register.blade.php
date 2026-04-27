@extends('layouts.app')

@section('title', 'Inscription - Fleet Premium')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 p-5 animate-up">
                <div class="text-center mb-4">
                    <h2 class="fw-bold">Rejoignez <span class="text-success">Fleet Premium</span></h2>
                    <p class="text-muted">Commencez votre voyage de luxe dès aujourd'hui.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nom complet</label>
                        <input type="text" name="name" class="form-control bg-light border-0 py-2" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control bg-light border-0 py-2" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control bg-light border-0 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" class="form-control bg-light border-0 py-2" required>
                    </div>

                    <button type="submit" class="btn btn-primary-green w-100 py-3 rounded-3 mb-3">S'INSCRIRE</button>
                    
                    <div class="text-center">
                        <p class="small text-muted mb-0">Déjà inscrit ? <a href="{{ route('login') }}" class="text-success fw-bold">Se connecter</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
