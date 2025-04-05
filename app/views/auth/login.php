<?php
// Extraction des variables
if (isset($data)) {
    extract($data);
}
?>

<style>
.login-container {
    min-height: calc(100vh - 200px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background: linear-gradient(135deg, rgba(65, 113, 214, 0.05) 0%, rgba(62, 100, 255, 0.05) 100%);
}

.login-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 450px;
    padding: 2.5rem;
    transition: transform 0.3s ease;
}

.login-card:hover {
    transform: translateY(-5px);
}

.login-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.login-title {
    color: #1e293b;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.login-subtitle {
    color: #64748b;
    font-size: 1rem;
    margin-bottom: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
    position: relative;
}

.form-label {
    display: block;
    color: #1e293b;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.form-control {
    width: 100%;
    padding: 0.8rem 1rem;
    font-size: 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    transition: all 0.3s ease;
    background: #f8fafc;
}

.form-control:focus {
    border-color: #4171d6;
    box-shadow: 0 0 0 4px rgba(65, 113, 214, 0.1);
    outline: none;
}

.form-control.is-invalid {
    border-color: #ef4444;
    background-image: none;
}

.invalid-feedback {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.btn-login {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #4171d6 0%, #3e64ff 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(65, 113, 214, 0.3);
}

.btn-login:active {
    transform: translateY(0);
}

.form-footer {
    text-align: center;
    margin-top: 2rem;
    color: #64748b;
}

.form-footer a {
    color: #4171d6;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.form-footer a:hover {
    color: #3e64ff;
}

.alert {
    padding: 1rem;
    border-radius: 10px;
    margin-bottom: 2rem;
    font-weight: 500;
}

.alert-danger {
    background: #fee2e2;
    color: #ef4444;
    border: 1px solid #fecaca;
}

.alert-success {
    background: #dcfce7;
    color: #10b981;
    border: 1px solid #bbf7d0;
}

@media (max-width: 768px) {
    .login-card {
        padding: 2rem;
    }
    
    .login-title {
        font-size: 1.75rem;
    }
}
</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h1 class="login-title"><?= $title ?? 'Connexion' ?></h1>
            <p class="login-subtitle">Connectez-vous pour accéder à votre espace</p>
        </div>

        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-<?= $_SESSION['flash_message']['type'] ?>" role="alert">
                <?= $_SESSION['flash_message']['message'] ?>
            </div>
            <?php unset($_SESSION['flash_message']); ?>
        <?php endif; ?>

        <form action="/srx/auth/login" method="POST" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email" required>
                <div class="invalid-feedback">
                    Veuillez entrer une adresse email valide
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                <div class="invalid-feedback">
                    Le mot de passe est requis
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Se connecter
            </button>

            <div class="form-footer">
                <p>Vous n'avez pas de compte ? <a href="/srx/auth/register">Inscrivez-vous</a></p>
            </div>
        </form>
    </div>
</div>

<script>
// Validation des formulaires
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()
</script>