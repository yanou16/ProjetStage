<?php 
$title = $data['title'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SRX - Gestion des stages' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--dark);
            background-color: var(--light);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .login-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: transparent;
            border-bottom: none;
            padding-top: 2rem;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            padding: 0.75rem 2rem;
            border-radius: 50px;
        }

        .btn-primary:hover {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="text-center mb-4">
                        <a href="/srx" class="text-decoration-none">
                            <i class="fas fa-graduation-cap fa-3x text-primary"></i>
                            <h1 class="h3 mt-2">Stageflow - Gestion des stages</h1>
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2 class="text-center h4"><?= $data['title'] ?></h2>
                        </div>
                        <div class="card-body">
                            <?php if (isset($_SESSION['flash'])): ?>
                                <div class="alert alert-<?= $_SESSION['flash']['type'] ?>" role="alert">
                                    <?= $_SESSION['flash']['message'] ?>
                                </div>
                            <?php endif; ?>
                            
                            <form action="/srx/users/login" method="POST">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email :</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe :</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>