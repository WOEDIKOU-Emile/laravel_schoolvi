@extends('layouts.app')

@push('styles')
<style>
    .page-header {
        margin-bottom: 3rem;
        text-align: center;
        padding: 2rem 0;
    }

    .page-header h1 {
        font-size: 32px;
        font-weight: 300;
        color: var(--dark-blue);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .page-header h1::before {
        
        font-size: 28px;
    }

    .page-header p {
        font-size: 16px;
        color: var(--text-gray);
        margin-top: 4px;
        font-weight: 400;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 3rem;
    }

    .stat {
        background: white;
        border: 2px solid var(--primary);
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary);
    }

    .stat:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .stat .label {
        font-size: 14px;
        color: var(--text-gray);
        margin-bottom: 8px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat .val {
        font-size: 36px;
        font-weight: 700;
        color: var(--dark-blue);
        line-height: 1;
    }

    .card {
        background: white;
        border: 2px solid var(--primary);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .card h2 {
        font-size: 20px;
        font-weight: 600;
        color: var(--dark-blue);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card h2::before {
        content: '📝';
        font-size: 22px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .field label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: var(--dark-blue);
        margin-bottom: 8px;
        text-transform: none;
        letter-spacing: normal;
    }

    .field input, .field select, .field textarea {
        width: 100%;
        padding: 12px 16px;
        font-size: 15px;
        font-family: inherit;
        border: 2px solid #e1e5e9;
        border-radius: 12px;
        background: var(--light-gray);
        color: var(--text-dark);
        transition: all 0.3s ease;
    }

    .field input:focus, .field select:focus, .field textarea:focus {
        outline: none;
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.1);
    }

    .field {
        margin-bottom: 1.5rem;
    }

    .btn-add {
        padding: 12px 24px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 1rem;
    }

    .btn-add:hover {
        background: #ff9500;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 165, 0, 0.3);
    }

    .btn-add::before {
        content: '➕';
        font-size: 16px;
    }

    .todo-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .empty {
        text-align: center;
        padding: 3rem 2rem;
        color: var(--text-gray);
        font-size: 16px;
        background: var(--light-gray);
        border-radius: 16px;
        border: 2px dashed #e1e5e9;
    }

    .empty::before {
        content: '📭';
        font-size: 48px;
        display: block;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .todo-item {
        display: flex;
        align-items: center;
        gap: 16px;
        background: white;
        border: 2px solid #e1e5e9;
        border-radius: 16px;
        padding: 16px 20px;
        transition: all 0.3s ease;
        position: relative;
    }

    .todo-item:hover {
        border-color: var(--primary);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .todo-item.done {
        background: #f8f9fa;
        border-color: #a8e6c1;
        opacity: 0.8;
    }

    .todo-item.done::before {
        content: '✓';
        position: absolute;
        right: 16px;
        top: 16px;
        color: #1a6b3c;
        font-size: 18px;
        font-weight: bold;
    }

    .todo-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--dark-blue);
        margin-bottom: 4px;
    }

    .todo-item.done .todo-title {
        text-decoration: line-through;
        color: #888;
    }

    .todo-meta {
        font-size: 13px;
        color: var(--text-gray);
        margin-top: 2px;
    }

    .todo-info {
        flex: 1;
    }

    .badge {
        font-size: 12px;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge.en-cours {
        background: linear-gradient(135deg, #EBF0FF 0%, #dbeafe 100%);
        color: var(--dark-blue);
        border: 1px solid rgba(0, 61, 102, 0.2);
    }

    .badge.done {
        background: linear-gradient(135deg, #E6F4EC 0%, #d1fae5 100%);
        color: #1a7340;
        border: 1px solid rgba(26, 115, 64, 0.2);
    }

    .todo-btns {
        display: flex;
        gap: 8px;
    }

    .btn-toggle {
        padding: 6px 14px;
        font-size: 13px;
        border-radius: 8px;
        border: 2px solid var(--primary);
        background: white;
        cursor: pointer;
        font-family: inherit;
        color: var(--primary);
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-toggle:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-1px);
    }

    .btn-del {
        padding: 6px 14px;
        font-size: 13px;
        border-radius: 8px;
        border: 2px solid #dc3545;
        background: white;
        cursor: pointer;
        font-family: inherit;
        color: #dc3545;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-del:hover {
        background: #dc3545;
        color: white;
        transform: translateY(-1px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 24px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .card {
            padding: 1.5rem;
        }

        .todo-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .todo-btns {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h1>Bonjour, {{ auth()->user()->prenom }} !</h1>
    <p>Gérez vos documents et tâches ici.</p>
</div>

<div class="stats-grid">
    <div class="stat">
        <div class="label">Total</div>
        <div class="val">{{ $documents->count() }}</div>
    </div>
    <div class="stat">
        <div class="label">En cours</div>
        <div class="val">{{ $documents->where('termine', false)->count() }}</div>
    </div>
    <div class="stat">
        <div class="label">Terminées</div>
        <div class="val">{{ $documents->where('termine', true)->count() }}</div>
    </div>
</div>

<div class="card">
    <h2>Nouvelle tâche</h2>
    <form method="POST" action="/documents">
        @csrf
        <div class="field">
            <label>Titre</label>
            <input type="text" name="titre" placeholder="Ex: Préparer le TP de chimie..." required value="{{ old('titre') }}">
        </div>
        <div class="form-grid">
            <div class="field">
                <label>Matière</label>
                <select name="idMatiere" required>
                    <option value="">-- Choisir --</option>
                    @foreach($matieres as $m)
                        <option value="{{ $m->idMatiere }}">{{ $m->nomMatiere }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label>Niveau</label>
                <select name="idNiveau" required>
                    <option value="">-- Choisir --</option>
                    @foreach($niveaux as $n)
                        <option value="{{ $n->idNiveau }}">{{ $n->nomNiveau }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="field">
            <label>Description (optionnel)</label>
            <input type="text" name="description" placeholder="Quelques détails...">
        </div>
        <button type="submit" class="btn-add">Ajouter la tâche</button>
    </form>
</div>

<div class="card">
    <h2>Mes tâches</h2>
    @if($documents->isEmpty())
        <div class="empty">Aucune tâche pour l'instant. Ajoutez-en une ci-dessus !</div>
    @else
    <div class="todo-list">
        @foreach($documents as $doc)
        <div class="todo-item {{ $doc->termine ? 'done' : '' }}">
            <div class="todo-info">
                <div class="todo-title">{{ $doc->titre }}</div>
                <div class="todo-meta">{{ $doc->matiere->nomMatiere }} · {{ $doc->niveau->nomNiveau }}
                    @if($doc->description)· {{ $doc->description }}@endif
                </div>
            </div>
            <span class="badge {{ $doc->termine ? 'done' : 'en-cours' }}">
                {{ $doc->termine ? 'Terminé' : 'En cours' }}
            </span>
            <div class="todo-btns">
                <form method="POST" action="/documents/{{ $doc->idDocument }}/toggle">
                    @csrf @method('PATCH')
                    <button class="btn-toggle">{{ $doc->termine ? '↩ Reprendre' : '✔ Terminer' }}</button>
                </form>
                <form method="POST" action="/documents/{{ $doc->idDocument }}">
                    @csrf @method('DELETE')
                    <button class="btn-del" onclick="return confirm('Supprimer cette tâche ?')">Suppr.</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection