<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocManager</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: #F4F4F0; color: #1a1a1a; min-height: 100vh; }
        .navbar { background: #fff; border-bottom: 1px solid #e8e8e3; padding: 0 2rem; height: 60px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }
        .navbar .brand { font-size: 17px; font-weight: 600; color: #1a1a1a; text-decoration: none; }
        .navbar nav { display: flex; align-items: center; gap: 1.5rem; }
        .navbar nav a { font-size: 14px; color: #666; text-decoration: none; }
        .navbar nav a:hover { color: #1a1a1a; }
        .btn-logout { background: none; border: 1px solid #f0d0d0; color: #c0392b; padding: 5px 14px; border-radius: 8px; font-size: 13px; cursor: pointer; font-family: inherit; }
        .btn-logout:hover { background: #fff5f5; }
        main { max-width: 900px; margin: 2rem auto; padding: 0 1.5rem; }
        .alert-success { background: #d4f5e3; border: 1px solid #a8e6c1; color: #1a6b3c; padding: 10px 16px; border-radius: 8px; margin-bottom: 1rem; font-size: 14px; }
        .alert-error { background: #fde8e8; border: 1px solid #f5c0c0; color: #9b1c1c; padding: 10px 16px; border-radius: 8px; margin-bottom: 1rem; font-size: 14px; }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar">
    <a href="/" class="brand">Schoolvi</a>
    <nav>
        @auth
            <span style="font-size:14px;color:#888">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</span>
            @if(auth()->user()->isAdmin())
                <a href="/admin/dashboard">Admin</a>
            @else
                <a href="/dashboard">Mes tâches</a>
            @endif
            <form method="POST" action="/logout" style="display:inline">
                @csrf
                <button class="btn-logout" type="submit">Déconnexion</button>
            </form>
        @else
            <a href="/login">Connexion</a>
            <a href="/register">Inscription</a>
        @endauth
    </nav>
</nav>
<main>
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    @yield('content')
</main>
</body>
</html>