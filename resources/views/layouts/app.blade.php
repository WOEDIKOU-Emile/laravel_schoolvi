<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School-Vi - Plateforme Éducative</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #FFA500;
            --dark-blue: #003d66;
            --light-bg: #faf8f3;
            --light-gray: #f8f9fa;
            --text-dark: #1a1a1a;
            --text-gray: #666;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--light-bg);
            color: var(--text-dark);
            min-height: 100vh;
            line-height: 1.6;
        }

        .navbar {
            background: linear-gradient(135deg, var(--light-bg) 0%, #ffffff 100%);
            border-bottom: 2px solid var(--primary);
            padding: 0 2rem;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .navbar .brand {
            font-size: 20px;
            font-weight: 600;
            color: var(--dark-blue);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar .brand::before {
            content: 'School';
            color: var(--dark-blue);
        }

        .navbar .brand::after {
            content: '-Vi';
            color: var(--primary);
        }

        .navbar nav {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .navbar nav a {
            font-size: 14px;
            color: var(--text-gray);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar nav a:hover {
            color: var(--primary);
            background: rgba(255, 165, 0, 0.1);
        }

        .navbar nav a.active {
            color: var(--primary);
            background: rgba(255, 165, 0, 0.1);
            font-weight: 600;
        }

        .user-info {
            font-size: 14px;
            color: var(--text-gray);
            margin-right: 12px;
        }

        .btn-logout {
            background: var(--primary);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            cursor: pointer;
            font-family: inherit;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-logout:hover {
            background: #ff9500;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 165, 0, 0.3);
        }

        .btn-login {
            background: var(--primary);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-login:hover {
            background: #ff9500;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 165, 0, 0.3);
        }

        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4f5e3 0%, #e6f4ec 100%);
            border: 2px solid #a8e6c1;
            color: #1a6b3c;
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success::before {
            content: '✓';
            color: #1a6b3c;
            font-weight: bold;
        }

        .alert-error {
            background: linear-gradient(135deg, #fde8e8 0%, #fef2f2 100%);
            border: 2px solid #f5c0c0;
            color: #9b1c1c;
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-error::before {
            content: '⚠';
            color: #9b1c1c;
            font-weight: bold;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 0 1rem;
                height: 60px;
            }

            .navbar .brand {
                font-size: 18px;
            }

            .navbar nav {
                gap: 1rem;
            }

            main {
                margin: 1rem auto;
                padding: 0 1rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar">
    <a href="/" class="brand"></a>
    <nav>
        @auth
            <span class="user-info">
                <i class="fas fa-user-circle"></i> {{ auth()->user()->prenom }} {{ auth()->user()->nom }}
            </span>
            @if(auth()->user()->isAdmin())
                <a href="/admin/dashboard" class="{{ request()->is('admin/*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> Admin
                </a>
            @else
                <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tasks"></i> Mes tâches
                </a>
            @endif
            <form method="POST" action="/logout" style="display:inline">
                @csrf
                <button class="btn-logout" type="submit">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </button>
            </form>
        @else
            <a href="/login" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Connexion
            </a>
            <a href="/register" class="btn-login">
                <i class="fas fa-user-plus"></i> Inscription
            </a>
        @endauth
    </nav>
</nav>
<main>
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('content')
</main>
</body>
</html>