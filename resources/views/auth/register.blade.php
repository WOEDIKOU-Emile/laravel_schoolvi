@extends('layouts.app')

@push('styles')
<style>
.auth-wrapper { display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 60px); margin-top: -2rem; padding: 2rem 0; }
.auth-card { background: #fff; border: 1px solid #e8e8e3; border-radius: 16px; padding: 2.5rem; width: 100%; max-width: 440px; }
.auth-card h1 { font-size: 22px; font-weight: 600; color: #1a1a1a; margin-bottom: 6px; }
.auth-card .subtitle { font-size: 14px; color: #888; margin-bottom: 2rem; }
.field { margin-bottom: 1.2rem; }
.field label { display: block; font-size: 12px; font-weight: 500; color: #666; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.04em; }
.field input { width: 100%; padding: 10px 12px; font-size: 14px; font-family: inherit; border: 1px solid #ddd; border-radius: 8px; background: #fafafa; color: #1a1a1a; transition: border-color 0.15s; }
.field input:focus { outline: none; border-color: #4A6CF7; background: #fff; }
.grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.btn-submit { width: 100%; padding: 11px; background: #1a1a1a; color: #fff; border: none; border-radius: 8px; font-size: 15px; font-weight: 500; cursor: pointer; font-family: inherit; transition: opacity 0.15s; }
.btn-submit:hover { opacity: 0.85; }
.auth-footer { margin-top: 1.5rem; text-align: center; font-size: 13px; color: #888; }
.auth-footer a { color: #4A6CF7; text-decoration: none; font-weight: 500; }
</style>
@endpush

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <h1>Créer un compte</h1>
        <p class="subtitle">Rejoignez DocManager et gérez vos tâches.</p>

        <form method="POST" action="/register">
            @csrf
            <div class="grid-2">
                <div class="field">
                    <label>Nom</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Dupont" required>
                </div>
                <div class="field">
                    <label>Prénom</label>
                    <input type="text" name="prenom" value="{{ old('prenom') }}" placeholder="Jean" required>
                </div>
            </div>
            <div class="field">
                <label>Adresse email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="vous@exemple.com" required>
            </div>
            <div class="field">
                <label>Mot de passe</label>
                <input type="password" name="password" placeholder="Min. 6 caractères" required>
            </div>
            <div class="field">
                <label>Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-submit">Créer mon compte</button>
        </form>

        <div class="auth-footer">
            Déjà inscrit ? <a href="/login">Se connecter</a>
        </div>
    </div>
</div>
@endsection