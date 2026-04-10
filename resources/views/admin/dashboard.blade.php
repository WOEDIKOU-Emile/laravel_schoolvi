@extends('layouts.app')

@push('styles')
<style>
.admin-header { display: flex; align-items: center; gap: 12px; margin-bottom: 2rem; }
.admin-header h1 { font-size: 22px; font-weight: 600; }
.admin-badge { font-size: 11px; padding: 3px 12px; border-radius: 20px; background: #FEF3C7; color: #92400E; font-weight: 500; }
.stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 2rem; }
.stat { background: #fff; border: 1px solid #e8e8e3; border-radius: 12px; padding: 1rem 1.25rem; }
.stat .label { font-size: 12px; color: #999; }
.stat .val { font-size: 26px; font-weight: 600; color: #1a1a1a; }
.section-label { font-size: 12px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 12px; }
.card { background: #fff; border: 1px solid #e8e8e3; border-radius: 16px; overflow: hidden; margin-bottom: 1.5rem; }
table { width: 100%; border-collapse: collapse; font-size: 14px; }
thead th { text-align: left; padding: 12px 16px; font-size: 12px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 0.04em; border-bottom: 1px solid #f0f0ea; background: #fafafa; }
tbody td { padding: 12px 16px; color: #1a1a1a; border-bottom: 1px solid #f0f0ea; }
tbody tr:last-child td { border-bottom: none; }
.avatar { width: 30px; height: 30px; border-radius: 50%; background: #EBF0FF; color: #3B5AF6; font-size: 11px; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; }
.user-cell { display: flex; align-items: center; gap: 10px; }
.btn-del { padding: 5px 12px; font-size: 12px; border-radius: 7px; border: 1px solid #f5c0c0; background: #fff; cursor: pointer; font-family: inherit; color: #c0392b; }
.btn-del:hover { background: #fff5f5; }
.status-done { font-size: 11px; padding: 3px 10px; border-radius: 20px; background: #E6F4EC; color: #1a7340; font-weight: 500; }
.status-en-cours { font-size: 11px; padding: 3px 10px; border-radius: 20px; background: #EBF0FF; color: #3B5AF6; font-weight: 500; }
</style>
@endpush

@section('content')
<div class="admin-header">
    <h1>Tableau de bord</h1>
    <span class="admin-badge">Admin</span>
</div>

<div class="stats-grid">
    <div class="stat"><div class="label">Utilisateurs</div><div class="val">{{ $users->count() }}</div></div>
    <div class="stat"><div class="label">Documents</div><div class="val">{{ $documents->count() }}</div></div>
    <div class="stat"><div class="label">Terminés</div><div class="val">{{ $documents->where('termine', true)->count() }}</div></div>
</div>

<p class="section-label">Gestion des utilisateurs</p>
<div class="card">
    <table>
        <thead>
            <tr><th>Utilisateur</th><th>Email</th><th>Tâches</th><th>Action</th></tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>
                    <div class="user-cell">
                        <div class="avatar">{{ strtoupper(substr($user->prenom,0,1).substr($user->nom,0,1)) }}</div>
                        {{ $user->prenom }} {{ $user->nom }}
                    </div>
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->documents_count }}</td>
                <td>
                    <form method="POST" action="/admin/users/{{ $user->id }}">
                        @csrf @method('DELETE')
                        <button class="btn-del" onclick="return confirm('Supprimer {{ $user->prenom }} ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center;color:#bbb;padding:2rem">Aucun utilisateur.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<p class="section-label">Tous les documents</p>
<div class="card">
    <table>
        <thead>
            <tr><th>Titre</th><th>Utilisateur</th><th>Matière</th><th>Statut</th></tr>
        </thead>
        <tbody>
            @forelse($documents as $doc)
            <tr>
                <td>{{ $doc->titre }}</td>
                <td>{{ $doc->utilisateur->prenom }} {{ $doc->utilisateur->nom }}</td>
                <td>{{ $doc->matiere->nomMatiere }}</td>
                <td>
                    <span class="{{ $doc->termine ? 'status-done' : 'status-en-cours' }}">
                        {{ $doc->termine ? 'Terminé' : 'En cours' }}
                    </span>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center;color:#bbb;padding:2rem">Aucun document.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection