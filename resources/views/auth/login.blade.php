@extends('layouts.app')

@push('styles')
<style>
.auth-wrapper { display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 60px); margin-top: -2rem; }
.auth-card { background: #fff; border: 1px solid #e8e8e3; border-radius: 16px; padding: 2.5rem; width: 100%; max-width: 400px; }
.auth-card h1 { font-size: 22px; font-weight: 600; color: #1a1a1a; margin-bottom: 6px; }
.auth-card .subtitle { font-size: 14px; color: #888; margin-bottom: 2rem; }
.field { margin-bottom: 1.2rem; }
.field label { display: block; font-size: 12px; font-weight: 500; color: #666; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.04em; }
.field input { width: 100%; padding: 10px 12px; font-size: 14px; font-family: inherit; border: 1px solid #ddd; border-radius: 8px; background: #fafafa; color: #1a1a1a; transition: border-color 0.15s; }
.field input:focus { outline: none; border-color: #4A6CF7; background: #fff; }
.btn-submit { width: 100%; padding: 11px; background: #1a1a1a; color: #fff; border: none; border-radius: 8px; font-size: 15px; font-weight: 500; cursor: pointer; font-family: inherit; transition: opacity 0.15s; }
.btn-submit:hover { opacity: 0.85; }
.auth-footer { margin-top: 1.5rem; text-align: center; font-size: 13px; color: #888; }
.auth-footer a { color: #4A6CF7; text-decoration: none; font-weight: 500; }
</style>
@endpush

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <h1>Connexion</h1>
        <p class="subtitle">Entrez vos identifiants pour accéder à votre espace.</p>

        <form method="POST" action="/login">
            @csrf
            <div class="field">
                <label>Adresse email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="vous@exemple.com" required autofocus>
            </div>
            <div class="field">
                <label>Mot de passe</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-submit">Se connecter</button>
        </form>

        <div class="auth-footer">
            Pas encore inscrit ? <a href="/register">Créer un compte</a>
        </div>
    </div>
</div>
@endsection