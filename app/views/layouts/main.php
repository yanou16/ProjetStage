<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SRX - Gestion des stages' ?></title>
    
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

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
        }

        nav {
            display: flex;
            gap: 2rem;
        }

        nav a {
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: var(--primary);
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
            font-size: 0.9rem;
            width: 200px;
        }

        .search-button {
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
        }

        /* Main Content */
        main {
            margin-top: 80px;
            min-height: calc(100vh - 80px - 100px);
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
            background: white;
            padding: 2rem 0;
            text-align: center;
            color: var(--gray);
            border-top: 1px solid #e2e8f0;
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
            .header-container {
                flex-direction: column;
                gap: 1rem;
            }

            nav {
                flex-wrap: wrap;
                justify-content: center;
            }

            .search-bar {
                width: 100%;
            }

            .search-input {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="/srx" class="logo">
                <i class="fas fa-graduation-cap"></i> SRX
            </a>
            <nav>
                <a href="/srx"><i class="fas fa-home"></i> Accueil</a>
                <?php if (isset($_SESSION['user'])): ?>
                    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                        <a href="/srx/users"><i class="fas fa-users"></i> Utilisateurs</a>
                    <?php endif; ?>
                    
                    <?php if ($_SESSION['user']['role'] === 'student'): ?>
                        <a href="/srx/internships/myApplications"><i class="fas fa-file-alt"></i> Mes candidatures</a>
                        <a href="/srx/internships/myWishlist"><i class="fas fa-star"></i> Favoris</a>
                    <?php endif; ?>

                    <a href="/srx/pilots"><i class="fas fa-user-tie"></i> Pilotes</a>
                    <a href="/srx/companies"><i class="fas fa-building"></i> Entreprises</a>
                    <a href="/srx/internships"><i class="fas fa-briefcase"></i> Stages</a>
                <?php endif; ?>
            </nav>
            <?php if (isset($_SESSION['user'])): ?>
                <div class="search-bar">
                    <input type="search" class="search-input" placeholder="Rechercher...">
                    <button class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            <?php endif; ?>
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
            <p> <?= date('Y') ?> SRX - Tous droits réservés</p>
            <p class="mt-2">
                <a href="/srx/privacy" class="text-gray">Politique de confidentialité</a> |
                <a href="/srx/terms" class="text-gray">Conditions d'utilisation</a>
            </p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
</body>
</html>