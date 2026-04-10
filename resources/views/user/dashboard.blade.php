@extends('layouts.app')

@push('styles')
<style>
.page-header { margin-bottom: 2rem; }
.page-header h1 { font-size: 22px; font-weight: 600; color: #1a1a1a; }
.page-header p { font-size: 14px; color: #888; margin-top: 4px; }

.stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 2rem; }
.stat { background: #fff; border: 1px solid #e8e8e3; border-radius: 12px; padding: 1rem 1.25rem; }
.stat .label { font-size: 12px; color: #999; margin-bottom: 4px; }
.stat .val { font-size: 26px; font-weight: 600; color: #1a1a1a; }

.card { background: #fff; border: 1px solid #e8e8e3; border-radius: 16px; padding: 1.5rem; margin-bottom: 1.5rem; }
.card h2 { font-size: 15px; font-weight: 600; color: #1a1a1a; margin-bottom: 1.25rem; }
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.field label { display: block; font-size: 12px; font-weight: 500; color: #666; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.04em; }
.field input, .field select, .field textarea { width: 100%; padding: 9px 12px; font-size: 14px; font-family: inherit; border: 1px solid #ddd; border-radius: 8px; background: #fafafa; color: #1a1a1a; }
.field input:focus, .field select:focus { outline: none; border-color: #4A6CF7; }
.field { margin-bottom: 1rem; }
.btn-add { padding: 9px 20px; background: #1a1a1a; color: #fff; border: none; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer; font-family: inherit; }

.todo-list { display: flex; flex-direction: column; gap: 8px; }
.empty { text-align: center; padding: 2rem; color: #bbb; font-size: 14px; }
.todo-item { display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid #e8e8e3; border-radius: 10px; padding: 12px 16px; }
.todo-item.done { background: #fafafa; border-color: #f0f0ea; }
.todo-title { font-size: 14px; font-weight: 500; color: #1a1a1a; }
.todo-item.done .todo-title { text-decoration: line-through; color: #bbb; }
.todo-meta { font-size: 12px; color: #aaa; margin-top: 2px; }
.todo-info { flex: 1; }
.badge { font-size: 11px; padding: 3px 10px; border-radius: 20px; font-weight: 500; }
.badge.en-cours { background: #EBF0FF; color: #3B5AF6; }
.badge.done { background: #E6F4EC; color: #1a7340; }
.todo-btns { display: flex; gap: 6px; }
.btn-toggle { padding: 5px 12px; font-size: 12px; border-radius: 7px; border: 1px solid #ddd; background: #fff; cursor: pointer; font-family: inherit; color: #444; }
.btn-toggle:hover { border-color: #1a7340; color: #1a7340; }
.btn-del { padding: 5px 12px; font-size: 12px; border-radius: 7px; border: 1px solid #f5c0c0; background: #fff; cursor: pointer; font-family: inherit; color: #c0392b; }
.btn-del:hover { background: #fff5f5; }
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