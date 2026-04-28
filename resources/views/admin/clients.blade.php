@extends('layouts.admin')

@section('title', 'Gestion des Clients - Admin Fleet Premium')
@section('page_title', 'Gestion des Clients')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white p-4 d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Liste des Clients</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="p-4">ID</th>
                    <th class="p-4">Nom</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Date d'inscription</th>
                    <th class="p-4">Statut Compte</th>
                    <th class="p-4 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td class="p-4">#{{ $client->id }}</td>
                    <td class="p-4 fw-bold">{{ $client->name }}</td>
                    <td class="p-4 text-muted">{{ $client->email }}</td>
                    <td class="p-4">{{ $client->created_at->format('d/m/Y') }}</td>
                    <td class="p-4">
                        @if($client->is_active)
                            <span class="badge bg-primary">Actif</span>
                        @else
                            <span class="badge bg-danger">Suspendu</span>
                        @endif
                    </td>
                    <td class="p-4 text-end">
                        <form action="{{ route('admin.users.toggle-active', $client->id) }}" method="POST">
                            @csrf
                            @if($client->is_active)
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Suspendre le compte">
                                    <i class="bi bi-pause-circle"></i> Suspendre
                                </button>
                            @else
                                <button type="submit" class="btn btn-sm btn-outline-primary" title="Activer le compte">
                                    <i class="bi bi-play-circle"></i> Activer
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-muted">Aucun client trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">
        {{ $clients->links() }}
    </div>
</div>
@endsection
