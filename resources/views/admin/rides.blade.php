@extends('layouts.admin')

@section('title', 'Gestion des Courses - Admin Fleet Premium')
@section('page_title', 'Historique des Courses')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white p-4 d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Toutes les courses</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="p-4">ID</th>
                    <th class="p-4">Client</th>
                    <th class="p-4">Chauffeur</th>
                    <th class="p-4">Trajet</th>
                    <th class="p-4">Tarif</th>
                    <th class="p-4">Statut</th>
                    <th class="p-4 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rides as $ride)
                <tr>
                    <td class="p-4">#{{ $ride->id }}</td>
                    <td class="p-4 fw-bold">{{ $ride->client->name }}</td>
                    <td class="p-4 text-muted">{{ $ride->driver ? $ride->driver->name : 'Non assigné' }}</td>
                    <td class="p-4">
                        <small class="d-block text-truncate" style="max-width: 150px;" title="{{ $ride->pickup_address }}">Départ: {{ $ride->pickup_address }}</small>
                        <i class="bi bi-arrow-down text-success small"></i>
                        <small class="d-block text-truncate" style="max-width: 150px;" title="{{ $ride->destination_address }}">Arrivée: {{ $ride->destination_address }}</small>
                    </td>
                    <td class="p-4 fw-bold text-success">{{ number_format($ride->price, 2) }} €</td>
                    <td class="p-4">
                        @if($ride->status === 'pending')
                            <span class="badge bg-warning text-dark">En attente</span>
                        @elseif($ride->status === 'accepted')
                            <span class="badge bg-info text-white">Accepté</span>
                        @elseif($ride->status === 'ongoing')
                            <span class="badge bg-primary">En cours</span>
                        @elseif($ride->status === 'completed')
                            <span class="badge bg-success">Terminé</span>
                        @elseif($ride->status === 'cancelled')
                            <span class="badge bg-danger">Annulé</span>
                        @endif
                    </td>
                    <td class="p-4 text-end">
                        <div class="d-flex justify-content-end gap-2">
                            @if(!in_array($ride->status, ['completed', 'cancelled']))
                            <form action="{{ route('admin.rides.cancel', $ride->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-warning" title="Annuler" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette course ?')">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('admin.rides.destroy', $ride->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer définitivement" onclick="return confirm('ATTENTION : Cette action est irréversible. Supprimer cette course ?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-muted">Aucune course trouvée.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">
        {{ $rides->links() }}
    </div>
</div>
@endsection
