<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Stageflow - Gestion des stages' ?></title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Variables globales et thème */
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #3b82f6;
            --accent: #60a5fa;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            
            /* Nouvelles variables pour les animations */
            --transition-smooth: cubic-bezier(0.4, 0, 0.2, 1);
            --transition-bounce: cubic-bezier(0.68, -0.55, 0.265, 1.55);
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 20px 25px rgba(0, 0, 0, 0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--dark);
            background-color: var(--light);
        }

        /* Header et Navigation */
        header {
            background: linear-gradient(135deg, #4171d6 0%, #3e64ff 100%);
            padding: 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1.5rem;
            height: 4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Logo avec animations avancées */
        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.4s var(--transition-bounce);
            padding: 0.5rem;
        }

        .logo:hover {
            transform: translateY(-2px);
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: transparent;
            border: none;
            box-shadow: none;
        }

        .logo:hover .logo-icon {
            transform: none;
        }

        /* Suppression des animations */
        .logo-icon {
            animation: none;
        }

        .logo-icon::after {
            display: none;
        }

        .logo span {
            position: relative;
            font-weight: 800;
            background: linear-gradient(to right, #ffffff, #e0e7ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo span::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(to right, #ffffff, #e0e7ff);
            transition: width 0.4s var(--transition-bounce);
        }

        .logo:hover span::after {
            width: 100%;
        }

        /* Navigation avec animations */
        .nav-group {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            opacity: 0.9;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
        }

        .nav-links a::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .nav-links a:hover {
            opacity: 1;
            transform: translateY(-2px);
        }

        .nav-links a:hover::before {
            transform: translateX(0);
        }

        .nav-links i {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .nav-links a:hover i {
            transform: rotate(10deg) scale(1.1);
        }

        /* User Actions dans la navbar uniquement */
        .header-container .user-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
        }

        .header-container .user-profile {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.3rem;
            background: #4171d6;
            border-radius: 100px;
            cursor: pointer;
            min-width: 200px;
        }

        .header-container .user-avatar {
            width: 28px;
            height: 28px;
            min-width: 28px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-container .user-avatar svg {
            width: 14px;
            height: 14px;
            color: #4171d6;
        }

        .header-container .user-name {
            color: white;
            font-size: 0.9rem;
            font-weight: normal;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
            padding-right: 0.5rem;
        }

        @media (max-width: 768px) {
            .header-container .user-profile {
                padding: 0.4rem;
                min-width: auto;
            }

            .header-container .user-name {
                display: none;
            }
        }

        /* Style pour les avatars dans la liste des utilisateurs */
        .user-list-avatar {
            width: 32px;
            height: 32px;
            min-width: 32px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #4171d6;
        }

        .user-list-avatar svg {
            width: 16px;
            height: 16px;
            color: #4171d6;
        }

        /* Menu Burger amélioré */
        .hamburger {
            display: none;
            cursor: pointer;
            padding: 0;
            background: none;
            border: none;
            margin-left: 1rem;
            z-index: 1002;
        }

        .bar {
            display: block;
            width: 22px;
            height: 2px;
            margin: 4px 0;
            background: white;
            transition: all 0.3s ease;
            transform-origin: left center;
        }

        .hamburger.active .bar:nth-child(1) {
            transform: rotate(45deg) translate(1px, -2px);
        }

        .hamburger.active .bar:nth-child(2) {
            opacity: 0;
            transform: translateX(-10px);
        }

        .hamburger.active .bar:nth-child(3) {
            transform: rotate(-45deg) translate(1px, 2px);
        }

        /* Version Mobile avec animations */
        @media (max-width: 768px) {
            .nav-group {
                display: none;
                position: fixed;
                top: 4rem;
                left: 0;
                width: 100%;
                height: calc(100vh - 4rem);
                background: linear-gradient(135deg, #4171d6 0%, #3e64ff 100%);
                padding: 1rem;
                opacity: 0;
                transform: translateY(-10px);
                transition: all 0.3s ease;
            }

            .nav-group.active {
                display: block;
                opacity: 1;
                transform: translateY(0);
            }

            .nav-links {
                flex-direction: column;
                width: 100%;
                gap: 0.5rem;
            }

            .nav-links a {
                width: 100%;
                padding: 1rem;
                transform: translateX(-10px);
                opacity: 0;
                animation: slideIn 0.3s ease forwards;
            }

            @keyframes slideIn {
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            .nav-links a:nth-child(1) { animation-delay: 0.1s; }
            .nav-links a:nth-child(2) { animation-delay: 0.2s; }
            .nav-links a:nth-child(3) { animation-delay: 0.3s; }
            .nav-links a:nth-child(4) { animation-delay: 0.4s; }

            .hamburger {
                display: block;
            }
        }

        /* Menu utilisateur */
        .user-menu {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            padding: 0.5rem;
            min-width: 200px;
            z-index: 1000;
        }

        .user-menu.active {
            display: block;
        }

        .user-menu-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.8rem 1rem;
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .user-menu-item:hover {
            background: rgba(65, 113, 214, 0.1);
            transform: translateX(5px);
        }

        .user-menu-item i {
            font-size: 1.1rem;
            color: #4171d6;
        }

        .user-menu-item.logout {
            color: #ef4444;
            border-top: 1px solid rgba(0, 0, 0, 0.08);
            margin-top: 0.5rem;
            padding-top: 1rem;
        }

        .user-menu-item.logout i {
            color: #ef4444;
        }

        .user-menu-item.logout:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        /* Main Content */
        main {
            margin-top: 80px;
            min-height: calc(100vh - 80px - 160px);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        /* Bouton décoratif (non-cliquable) */
        .btn-decorative {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #4171d6;
            color: white;
            border-radius: 100px;
            font-size: 0.9rem;
            font-weight: normal;
            pointer-events: none;
            user-select: none;
            opacity: 0.9;
        }

        .btn-decorative i {
            font-size: 0.9rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }

        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        .btn-login {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.6rem 1.2rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .btn-login i {
            font-size: 1.1rem;
        }

        /* Modification du style pour le bouton de connexion en mobile */
        @media (max-width: 768px) {
            .btn-login {
                padding: 0.5rem 1rem;
            }
            
            .btn-login span {
                display: none;
            }
            
            .btn-login i {
                margin: 0;
            }
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Footer */
        footer {
            background: linear-gradient(to right, #1e293b, #334155);
            color: #f8fafc;
            padding: 4rem 0 2rem;
            margin-top: 4rem;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--accent));
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-section h3 {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background: var(--primary);
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            color: var(--accent);
            transform: translateX(5px);
        }

        .footer-contact {
            color: #cbd5e1;
        }

        .footer-contact p {
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
        }

        /* Utilities */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .text-gradient {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <!-- Logo -->
            <a href="/srx" class="logo">
                <div class="logo-icon">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <!-- Base du chapeau -->
                        <path d="M15 55 L50 35 L85 55 L50 75 Z" 
                              fill="#475569" 
                              stroke="#334155"
                              stroke-width="1"/>
                        
                        <!-- Dessus du chapeau -->
                        <path d="M30 53 L70 53 L70 45 Q50 35 30 45 Z" 
                              fill="#334155"
                              stroke="#2c3a47"
                              stroke-width="0.5"/>
                        
                        <!-- Bord du chapeau -->
                        <path d="M25 53 L75 53" 
                              stroke="#2c3a47" 
                              stroke-width="1.5"/>
                        
                        <!-- Pompon -->
                        <circle cx="50" cy="35" r="4" 
                                fill="#60a5fa"
                                stroke="#3b82f6"
                                stroke-width="0.5"/>
                        
                        <!-- Détails supplémentaires -->
                        <path d="M50 35 L50 75" 
                              stroke="#334155" 
                              stroke-width="0.5" 
                              stroke-dasharray="2 2"/>
                        
                        <!-- Reflets -->
                        <path d="M20 55 Q50 45 80 55" 
                              fill="none"
                              stroke="#64748b" 
                              stroke-width="0.5"
                              opacity="0.3"/>
                        
                        <!-- Ombre sous le chapeau -->
                        <path d="M25 55 Q50 65 75 55" 
                              fill="none"
                              stroke="#1e293b" 
                              stroke-width="0.5"
                              opacity="0.2"/>
                        
                        <!-- Détails de texture -->
                        <path d="M35 50 L65 50" 
                              stroke="#64748b" 
                              stroke-width="0.5"
                              opacity="0.3"/>
                        <path d="M40 47 L60 47" 
                              stroke="#64748b" 
                              stroke-width="0.5"
                              opacity="0.3"/>
                    </svg>
                </div>
                <span>StageFlow</span>
            </a>

            <!-- Navigation -->
            <div class="nav-group">
                <nav>
                    <div class="nav-links">
                        <?php if (isset($_SESSION['user'])): ?>
                            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                                <a href="/srx/users" style="--i:1"><i class="fas fa-users"></i> Utilisateurs</a>
                                <a href="/srx/internships/myApplications" style="--i:2"><i class="fas fa-file-alt"></i> Candidatures</a>
                                <a href="/srx/internships/myWishlist" style="--i:3"><i class="fas fa-star"></i> Favoris</a>
                            <?php endif; ?>
                            
                            <?php if ($_SESSION['user']['role'] === 'student'): ?>
                                <a href="/srx/internships/myApplications" style="--i:1"><i class="fas fa-file-alt"></i> Candidatures</a>
                                <a href="/srx/internships/myWishlist" style="--i:2"><i class="fas fa-star"></i> Favoris</a>
                            <?php endif; ?>

                            <a href="/srx/companies" style="--i:4"><i class="fas fa-building"></i> Entreprises</a>
                            <a href="/srx/internships" style="--i:5"><i class="fas fa-briefcase"></i> Stages</a>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>

            <!-- Actions utilisateur -->
            <div class="user-actions">
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="user-profile" id="userProfileBtn">
                        <div class="user-avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                            </svg>
                        </div>
                        <span class="user-name"><?= htmlspecialchars($_SESSION['user']['email']) ?></span>
                    </div>
                    <div class="user-menu" id="userMenu">
                        <a href="/srx/profile" class="user-menu-item">
                            <i class="fas fa-user-circle"></i>
                            <span>Mon Profil</span>
                        </a>
                        <a href="/srx/users/logout" class="user-menu-item logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Déconnexion</span>
                        </a>
                    </div>
                <?php else: ?>
                    <a href="/srx/users/login" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Connexion</span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Menu Hamburger -->
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>

        <!-- Overlay pour le menu mobile -->
        <div class="nav-overlay"></div>
    </header>

    <main>
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="container" style="margin-top: 2rem;">
                <div class="alert alert-<?= $_SESSION['flash_message']['type'] ?>" role="alert">
                    <?= $_SESSION['flash_message']['message'] ?>
                </div>
            </div>
            <?php unset($_SESSION['flash_message']); ?>
        <?php endif; ?>

        <?= $content ?>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>À propos</h3>
                    <p class="footer-description">
                        Stageflow est la plateforme de gestion de stages de référence pour les étudiants et les entreprises.
                    </p>
                    <div class="footer-social">
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <div class="footer-section">
                    <h3>Liens rapides</h3>
                    <ul class="footer-links">
                       
                        <li><a href="/srx/about"><i class="fas fa-info-circle"></i> À propos</a></li>
                        <li><a href="/srx/privacy"><i class="fas fa-shield-alt"></i> Politique de confidentialité</a></li>
                        <li><a href="/srx/terms"><i class="fas fa-gavel"></i> Conditions d'utilisation</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Contact</h3>
                    <div class="footer-contact">
                        <p><i class="fas fa-map-marker-alt"></i> 123 Rue de l'Innovation, 75000 Paris</p>
                        <p><i class="fas fa-phone"></i> +33 1 23 45 67 89</p>
                        <p><i class="fas fa-envelope"></i> contact@stageflow.fr</p>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> Stageflow. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.querySelector('.hamburger');
            const navGroup = document.querySelector('.nav-group');
            const userProfileBtn = document.getElementById('userProfileBtn');
            const userMenu = document.getElementById('userMenu');

            // Menu burger
            if (hamburger && navGroup) {
                hamburger.addEventListener('click', function() {
                    hamburger.classList.toggle('active');
                    navGroup.classList.toggle('active');
                });
            }

            // Menu utilisateur
            if (userProfileBtn && userMenu) {
                userProfileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userMenu.classList.toggle('active');
                });

                // Fermer le menu utilisateur en cliquant ailleurs
                document.addEventListener('click', function(e) {
                    if (!userMenu.contains(e.target) && !userProfileBtn.contains(e.target)) {
                        userMenu.classList.remove('active');
                    }
                });
            }

            // Fermer les menus lors du redimensionnement
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    if (hamburger) hamburger.classList.remove('active');
                    if (navGroup) navGroup.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>