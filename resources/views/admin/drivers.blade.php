@extends('layouts.admin')

@section('title', 'Gestion des Chauffeurs - Admin Fleet Premium')
@section('page_title', 'Gestion des Chauffeurs')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white p-4 d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Liste des Chauffeurs</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="p-4">ID</th>
                    <th class="p-4">Nom</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Date d'inscription</th>
                    <th class="p-4">Statut Approbation</th>
                    <th class="p-4">Statut Compte</th>
                    <th class="p-4 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($drivers as $driver)
                <tr>
                    <td class="p-4">#{{ $driver->id }}</td>
                    <td class="p-4 fw-bold">{{ $driver->name }}</td>
                    <td class="p-4 text-muted">{{ $driver->email }}</td>
                    <td class="p-4">{{ $driver->created_at->format('d/m/Y') }}</td>
                    <td class="p-4">
                        @if($driver->is_approved)
                            <span class="badge bg-success">Approuvé</span>
                        @else
                            <span class="badge bg-warning text-dark">En attente</span>
                        @endif
                    </td>
                    <td class="p-4">
                        @if($driver->is_active)
                            <span class="badge bg-primary">Actif</span>
                        @else
                            <span class="badge bg-danger">Suspendu</span>
                        @endif
                    </td>
                    <td class="p-4 text-end">
                        <div class="d-flex justify-content-end gap-2">
                            @if(!$driver->is_approved)
                            <form action="{{ route('admin.users.approve', $driver->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" title="Approuver le chauffeur">
                                    <i class="bi bi-check-circle"></i> Approuver
                                </button>
                            </form>
                            @endif

                            <form action="{{ route('admin.users.toggle-active', $driver->id) }}" method="POST">
                                @csrf
                                @if($driver->is_active)
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Suspendre le compte">
                                        <i class="bi bi-pause-circle"></i> Suspendre
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-sm btn-outline-primary" title="Activer le compte">
                                        <i class="bi bi-play-circle"></i> Activer
                                    </button>
                                @endif
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-muted">Aucun chauffeur trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">
        {{ $drivers->links() }}
    </div>
</div>
@endsection
