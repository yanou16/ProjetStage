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
        :root {
            --primary: #2563eb;
            --secondary: #3b82f6;
            --accent: #60a5fa;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
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

        /* Header */
        header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .nav-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
            margin-left: 2rem;
        }

        .nav-links a {
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            font-size: 0.85rem;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .logo {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
        }

        .hamburger {
            display: none;
            cursor: pointer;
            z-index: 1001;
        }

        .bar {
            display: block;
            width: 25px;
            height: 2px;
            margin: 5px auto;
            transition: all 0.3s ease;
            background-color: var(--dark);
        }

        .close-menu {
            display: none;
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 24px;
            color: var(--dark);
            cursor: pointer;
            z-index: 1001;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: var(--light);
            border-radius: 50px;
            padding: 0.5rem 1rem;
            gap: 0.5rem;
            border: 1px solid #e2e8f0;
        }

        .search-input {
            border: none;
            background: none;
            outline: none;
            font-size: 0.85rem;
            width: 200px;
        }

        .search-button {
    
            font-size: 0.9rem;
        }

        .logout-button {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info {
            display: none; /* On le cache complètement car on utilise uniquement la version mobile */
        }

        .user-name {
            color: var(--dark);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                position: fixed;
                right: -100%;
                top: 0;
                flex-direction: column;
                background-color: white;
                width: 80%;
                height: 100vh;
                padding: 6rem 2rem;
                transition: 0.3s ease-in-out;
                margin: 0;
                box-shadow: -5px 0 15px rgba(0,0,0,0.1);
            }

            .nav-links .user-info-mobile {
                margin-top: 2rem;
                padding-top: 1rem;
                border-top: 1px solid rgba(0,0,0,0.1);
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }

            .nav-links.active {
                right: 0;
            }

            .hamburger {
                display: block;
            }

            .hamburger.active .bar:nth-child(2) {
                opacity: 0;
            }

            .hamburger.active .bar:nth-child(1) {
                transform: translateY(7px) rotate(45deg);
            }

            .hamburger.active .bar:nth-child(3) {
                transform: translateY(-7px) rotate(-45deg);
            }

            .nav-links a {
                font-size: 1.1rem;
                padding: 1rem 0;
            }

            .header-container {
                padding: 0 1rem;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .nav-links a {
            animation: fadeIn 0.5s ease forwards;
            opacity: 0;
            animation-delay: calc(0.1s * var(--i));
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="nav-group">
                <a href="/srx" class="logo">StageFlow</a>
                <nav>
                    <div class="nav-links">
                        <?php if (isset($_SESSION['user'])): ?>
                            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                                <a href="/srx/users" style="--i:1"><i class="fas fa-users"></i> Utilisateurs</a>
                                <a href="/srx/internships/myApplications" style="--i:2"><i class="fas fa-file-alt"></i> Mes candidatures</a>
                                <a href="/srx/internships/myWishlist" style="--i:3"><i class="fas fa-star"></i> Favoris</a>
                            <?php endif; ?>
                            
                            <?php if ($_SESSION['user']['role'] === 'student'): ?>
                                <a href="/srx/internships/myApplications" style="--i:1"><i class="fas fa-file-alt"></i> Mes candidatures</a>
                                <a href="/srx/internships/myWishlist" style="--i:2"><i class="fas fa-star"></i> Favoris</a>
                            <?php endif; ?>

                            <?php if ($_SESSION['user']['role'] === 'pilote'): ?>
                                
                            <?php endif; ?>

                            <a href="/srx/companies" style="--i:4"><i class="fas fa-building"></i> Entreprises</a>
                            <a href="/srx/internships" style="--i:5"><i class="fas fa-briefcase"></i> Stages</a>
                            
                            <div class="user-info-mobile">
                                <span class="user-name"><i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['user']['name'] ?? $_SESSION['user']['email']) ?></span>
                                <a href="/srx/users/logout"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                            </div>
                        <?php else: ?>
                            <a href="/srx/users/login" class="btn-login" style="--i:1"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
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
        document.addEventListener('DOMContentLoaded', () => {
            const hamburger = document.querySelector('.hamburger');
            const navLinks = document.querySelector('.nav-links');
            const links = document.querySelectorAll('.nav-links a');

            hamburger.addEventListener('click', () => {
                hamburger.classList.toggle('active');
                navLinks.classList.toggle('active');
            });

            links.forEach(link => {
                link.addEventListener('click', () => {
                    hamburger.classList.remove('active');
                    navLinks.classList.remove('active');
                });
            });
        });
    </script>
</body>
</html>