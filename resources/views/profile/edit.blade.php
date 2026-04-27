@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Modifier mon Profil - Fleet Premium')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4">Paramètres du <span class="text-success">Profil</span></h2>

            <!-- Update Profile Info -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-3">Informations personnelles</h5>
                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required autocomplete="username">
                    </div>

                    <button type="submit" class="btn btn-primary-green px-4">Enregistrer les modifications</button>
                </form>
            </div>

            <!-- Update Password -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-3">Changer le mot de passe</h5>
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label class="form-label">Mot de passe actuel</label>
                        <input type="password" name="current_password" class="form-control" autocomplete="current-password">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="password" class="form-control" autocomplete="new-password">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn btn-primary-green px-4">Mettre à jour le mot de passe</button>
                </form>
            </div>

            <!-- Delete Account -->
            <div class="card border-0 shadow-sm rounded-4 p-4 border-start border-danger border-4">
                <h5 class="fw-bold text-danger mb-3">Supprimer le compte</h5>
                <p class="text-muted small">Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.</p>
                <button type="button" class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Supprimer mon compte</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Supprimer Compte -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Êtes-vous sûr ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Veuillez entrer votre mot de passe pour confirmer la suppression définitive de votre compte.</p>
                <form method="post" action="{{ route('profile.destroy') }}" id="deleteForm">
                    @csrf
                    @method('delete')
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" form="deleteForm" class="btn btn-danger">Supprimer définitivement</button>
            </div>
        </div>
    </div>
</div>
@endsection
