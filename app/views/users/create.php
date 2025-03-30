<?php
// Extraction des variables (conservée telle quelle)
if (isset($data)) {
    extract($data);
}
?>

<div class="user-create-section">
    <div class="header-section">
        <div class="header-content">
            <h1 class="company-title"><?= $title ?? 'Créer un compte' ?></h1>
            <a href="/srx/users" class="btn-action btn-return">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            <div class="info-card">
                <div class="card-body">
                    <form action="/srx/users/create" method="POST" class="needs-validation" novalidate>
                        <div class="form-group">
                            <label for="username">Nom d'utilisateur *</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                            <div class="invalid-feedback">
                                Le nom d'utilisateur est requis
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">
                                Un email valide est requis
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe *</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div class="invalid-feedback">
                                Le mot de passe est requis
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirm">Confirmer le mot de passe *</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                            <div class="invalid-feedback">
                                La confirmation du mot de passe est requise
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role_id">Type de compte *</label>
                            <select class="form-control" id="role_id" name="role_id" required>
                                <option value="">Choisir un type de compte...</option>
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= $role['id'] ?>"><?= ucfirst($role['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Le type de compte est requis
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-action btn-submit">
                                <i class="fas fa-user-plus"></i> Créer le compte
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Variables */
:root {
    --primary: #2563eb;
    --primary-dark: #1e40af;
    --background: #f8fafc;
    --text-primary: #1e293b;
    --text-secondary: #64748b;
    --border: #e2e8f0;
    --danger: #dc3545;
    --success: #28a745;
}

/* Structure générale */
.user-create-section {
    background: var(--background);
    min-height: 100vh;
    padding-bottom: 2rem;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 1rem;
}

.form-container {
    padding-top: 1rem;
}

/* En-tête */
.header-section {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    padding: 1.5rem;
    margin-bottom: 2rem;
    color: white;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.company-title {
    font-size: 1.75rem;
    margin: 0;
    font-weight: 600;
}

/* Carte */
.info-card {
    background: white;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: 1px solid var(--border);
    transition: all 0.3s ease;
}

.info-card:hover {
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 2rem;
}

/* Formulaire */
.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--text-primary);
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid var(--border);
    border-radius: 0.5rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.1);
    outline: none;
}

.form-control.is-invalid {
    border-color: var(--danger);
}

.invalid-feedback {
    color: var(--danger);
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: none;
}

.was-validated .form-control:invalid ~ .invalid-feedback,
.was-validated .form-control:invalid ~ .invalid-feedback {
    display: block;
}

/* Boutons */
.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-return {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-submit {
    background: var(--primary);
    color: white;
    width: 100%;
    justify-content: center;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-return:hover {
    background: rgba(255, 255, 255, 0.2);
}

.btn-submit:hover {
    background: var(--primary-dark);
}

.form-actions {
    margin-top: 2rem;
}

/* Responsive */
@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .btn-action {
        width: 100%;
    }
    
    .card-body {
        padding: 1.5rem;
    }
}
</style>

<script>
// Validation des formulaires (conservée avec amélioration visuelle)
(function () {
    'use strict'

    var forms = document.querySelectorAll('.needs-validation')

    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                } else {
                    // Vérification des mots de passe
                    const password = document.getElementById('password')
                    const passwordConfirm = document.getElementById('password_confirm')
                    
                    if (password.value !== passwordConfirm.value) {
                        event.preventDefault()
                        event.stopPropagation()
                        passwordConfirm.setCustomValidity('Les mots de passe ne correspondent pas')
                        passwordConfirm.classList.add('is-invalid')
                        passwordConfirm.nextElementSibling.style.display = 'block'
                    } else {
                        passwordConfirm.setCustomValidity('')
                        passwordConfirm.classList.remove('is-invalid')
                        passwordConfirm.nextElementSibling.style.display = 'none'
                    }
                }

                form.classList.add('was-validated')
            }, false)
        })
})()
</script>