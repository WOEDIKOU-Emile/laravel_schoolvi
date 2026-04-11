@extends('layouts.app')

@push('styles')
<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body{
    background: url("/images/image2.jpg") no-repeat;
    background-position: center;
    background-size: cover;
}
.auth-wrapper{
    background-color: transparent;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: calc(100vh - 60px);
    padding: 2rem 0;
}
.auth-card{
    background-color: rgba(255,255,255,0.08);
    padding: 30px;
    width: min(560px, 100%);
    border-radius: 20px;
    border: 5px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(20px);
}
.auth-card h1{
    color: white;
    text-align: center;
    margin-bottom: 30px;
    font-size: 2rem;
}
.auth-card .subtitle{
    color: white;
    font-weight:bold;
    text-align: center;
    margin-bottom: 30px;
}
.field{
    margin-bottom: 20px;
    width: 100%;
}
.field label{
    display: block;
    color: white;
    font-size: 20px;
    margin-bottom: 10px;
}
.field input{
    width: 100%;
    padding: 20px;
    border-radius: 25px;
    outline: none;
    color: white;
    padding-right: 40px;
    border: 5px solid rgba(255,255,255,0.2);
    background-color: transparent;
    font-size: 20px;
}
.field input::placeholder{
    color: white;
}
.grid-2{
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}
.grid-2 .field{
    width: auto;
}
.grid-2 .field input{
    width: 100%;
}
.btn-submit{
    margin-bottom: 20px;
    padding: 10px;
    border-radius: 15px;
    outline: none;
    border: 5px solid white;
    font-size: 20px;
    width: 100%;
    background-color: transparent;
    color: white;
    cursor: pointer;
}
.btn-submit:hover{
    background-color: rgba(255,255,255,0.1);
}
.auth-footer{
    color: white;
    font-size: 20px;
    justify-content: center;
    text-align: center;
}
.auth-footer a{
    color: white;
    font-weight: bold;
    text-decoration: none;
}
</style>
@endpush

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <h1>Créer un compte</h1>
        <p class="subtitle">Rejoignez Schoolvi et explorez vos documents.</p>

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