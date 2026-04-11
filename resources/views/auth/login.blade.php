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