<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School-Vi - Plateforme Éducative de Partage de Documents</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #FFA500;
            --dark-blue: #003d66;
            --light-bg: #faf8f3;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary:hover {
            background: #ff9500;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 165, 0, 0.3);
        }

        .header-nav {
            background: linear-gradient(135deg, var(--light-bg) 0%, #ffffff 100%);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--light-bg) 0%, #f5f0e8 100%);
            padding: 60px 20px;
            position: relative;
            overflow: hidden;
        }

        .decorative-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            background: var(--primary);
            opacity: 0.1;
            border-radius: 12px;
        }

        .shape1 { width: 80px; height: 20px; top: 10%; left: 5%; transform: rotate(-20deg); }
        .shape2 { width: 50px; height: 50px; top: 20%; right: 8%; border-radius: 8px; }
        .shape3 { width: 60px; height: 15px; bottom: 15%; left: 10%; transform: rotate(20deg); }
        .shape4 { width: 45px; height: 45px; bottom: 25%; right: 5%; }

        .filter-card {
            background: white;
            border: 2px solid var(--primary);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .filter-group {
            margin-bottom: 20px;
        }

        .filter-label {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        .filter-select, .filter-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .filter-select:focus, .filter-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.1);
        }

        .reset-filters {
            color: var(--primary);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 12px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .reset-filters:hover {
            text-decoration: underline;
        }

        .cta-section {
            background: linear-gradient(135deg, var(--dark-blue) 0%, #004466 100%);
            padding: 80px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 200px;
            height: 200px;
            background: var(--primary);
            opacity: 0.1;
            border-radius: 50%;
            transform: translate(-100px, -100px);
        }

        .cta-title {
            color: white;
            font-size: 42px;
            font-weight: 300;
            margin-bottom: 30px;
            line-height: 1.4;
        }

        .footer {
            background: var(--dark-blue);
            color: white;
            padding: 50px 20px 30px;
        }

        .footer-section h3 {
            color: var(--primary);
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 12px;
        }

        .footer-section ul li a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: var(--primary);
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 18px;
        }

        .social-icon:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        .search-input-container {
            background: white;
            border: 2px solid var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            padding: 12px 16px;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-input-container input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 16px;
        }

        .search-input-container .search-icon {
            color: var(--primary);
            cursor: pointer;
            font-size: 18px;
        }

        .filter-icon {
            color: var(--primary);
            cursor: pointer;
            font-size: 20px;
        }

        .page-title {
            color: var(--dark-blue);
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }

        .subtitle {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: var(--dark-blue);
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .subtitle::before {
            content: '💡';
            font-size: 18px;
        }

        .section-description {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <!-- ========== HEADER ========== -->
    <header class="header-nav sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <span class="text-2xl font-bold" style="color: var(--dark-blue);">School</span>
                <span class="text-2xl font-bold" style="color: var(--primary);">-Vi</span>
            </div>

            <!-- Navigation Menu -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="#" class="text-gray-800 text-sm font-medium hover:text-primary transition">Accueil</a>
                <a href="#ressources" class="text-gray-800 text-sm font-medium hover:text-primary transition">Ressources</a>
                <a href="#" class="text-gray-800 text-sm font-medium hover:text-primary transition">Méthodologie</a>
                <a href="#" class="text-gray-800 text-sm font-medium hover:text-primary transition">Contact</a>
                <a href="#" class="text-gray-800 text-sm font-medium hover:text-primary transition">À propos</a>
                <a href="#" class="text-primary text-sm font-bold hover:text-orange-600 transition">Devenir partenaire</a>
            </nav>

            <!-- Right Actions -->
            <div class="flex items-center gap-4">
                <a href="javascript:void(0)" class="text-gray-800 text-xl">
                    <i class="fas fa-user-circle"></i>
                </a>
                <a href="{{ route('login') }}" class="btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Connexion
                </a>
            </div>
        </div>
    </header>

    <!-- ========== HERO SECTION ========== -->
    <section class="hero-section" id="ressources">
        <div class="decorative-shapes">
            <div class="shape shape1"></div>
            <div class="shape shape2"></div>
            <div class="shape shape3"></div>
            <div class="shape shape4"></div>
        </div>

        <div class="max-w-6xl mx-auto relative z-10">
            <!-- Title -->
            <div class="text-center mb-10">
                <div class="subtitle">NOTRE CATALOGUE</div>
                <h1 class="page-title">Toutes les ressources</h1>
            </div>

            <!-- Search Bar -->
            <div class="search-input-container max-w-2xl mx-auto mb-6">
                <i class="fas fa-search search-icon"></i>
                <input type="text"
                       id="searchInput"
                       placeholder="Rechercher une ressource..."
                       class="w-full">
                <i class="fas fa-sliders-h filter-icon" onclick="document.getElementById('filterCard').scrollIntoView({ behavior: 'smooth' })"></i>
            </div>

            <!-- Filter Card -->
            <div class="filter-card" id="filterCard">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Niveau Filter -->
                    <div class="filter-group">
                        <label class="filter-label">Niveau</label>
                        <select id="niveauFilter" class="filter-select">
                            <option value="">Niveau</option>
                            <option value="primaire">Primaire</option>
                            <option value="secondaire">Secondaire</option>
                            <option value="lycee">Lycée</option>
                        </select>
                    </div>

                    <!-- Discipline Filter -->
                    <div class="filter-group">
                        <label class="filter-label">Discipline</label>
                        <select id="matiereFilter" class="filter-select">
                            <option value="">Discipline</option>
                            <option value="francais">Français</option>
                            <option value="math">Mathématiques</option>
                            <option value="sciences">Sciences</option>
                            <option value="histoire">Histoire</option>
                        </select>
                    </div>

                    <!-- Type Filter -->
                    <div class="filter-group">
                        <label class="filter-label">Type de contenu</label>
                        <select id="typeFilter" class="filter-select">
                            <option value="">Type de contenu</option>
                            <option value="pdf">PDF</option>
                            <option value="video">Vidéo</option>
                            <option value="document">Document</option>
                            <option value="exercice">Exercice</option>
                        </select>
                    </div>
                </div>

                <div class="text-right mt-4">
                    <button onclick="resetFilters()" class="reset-filters">
                        <i class="fas fa-redo"></i> Tout réinitialiser
                    </button>
                </div>
            </div>

            <!-- Call to Action Button -->
            <div class="text-center mt-10">
                <a href="{{ route('login') }}" class="btn-primary text-lg">
                    <i class="fas fa-share"></i> Partagez vos documents avec nous
                </a>
            </div>
        </div>
    </section>

    <!-- ========== CTA SECTION ========== -->
    <section class="cta-section">
        <div class="max-w-4xl mx-auto relative z-10">
            <h2 class="cta-title">"Rejoignez la communauté School-Vi"</h2>
            <a href="{{ route('login') }}" class="btn-primary text-lg inline-block">
                <i class="fas fa-arrow-right"></i> Commencez maintenant !
            </a>
        </div>
    </section>

    <!-- ========== FOOTER ========== -->
    <footer class="footer">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- About -->
                <div class="footer-section">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-2xl font-bold">School</span>
                        <span class="text-2xl font-bold text-primary">-Vi</span>
                    </div>
                    <p class="text-sm opacity-90 leading-relaxed mb-4">
                        Une plateforme éducative dédiée au partage de documents scolaires, pour aider élèves, enseignants et parents à mieux réussir.
                    </p>
                    <div class="social-icons">
                        <a href="#" class="social-icon" title="Telegram">
                            <i class="fab fa-telegram"></i>
                        </a>
                        <a href="#" class="social-icon" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="#" class="social-icon" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-icon" title="Facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="social-icon" title="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>

                <!-- Liens Utiles -->
                <div class="footer-section">
                    <h3>Liens utiles</h3>
                    <ul>
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">Documents</a></li>
                        <li><a href="#">Méthodologie</a></li>
                        <li><a href="#">Publier un doc</a></li>
                        <li><a href="#">Connexion</a></li>
                    </ul>
                </div>

                <!-- Légal -->
                <div class="footer-section">
                    <h3>Légal</h3>
                    <ul>
                        <li><a href="#">Politique de confidentialité</a></li>
                        <li><a href="#">Conditions d'utilisation</a></li>
                        <li><a href="#">Mentions légales</a></li>
                    </ul>
                </div>

                <!-- À Propos -->
                <div class="footer-section">
                    <h3>School-Vi</h3>
                    <ul>
                        <li><a href="#">À propos</a></li>
                        <li><a href="#">Notre équipe</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-opacity-20 pt-6 text-center text-sm opacity-75">
                <p>&copy; 2024 School-Vi. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Réinitialiser les filtres
        function resetFilters() {
            document.getElementById('niveauFilter').value = '';
            document.getElementById('matiereFilter').value = '';
            document.getElementById('typeFilter').value = '';
            document.getElementById('searchInput').value = '';
        }
    </script>
</body>
</html>
