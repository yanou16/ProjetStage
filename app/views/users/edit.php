<div class="container-fluid user-edit-section">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="header-section">
                <h1 class="company-title">Modifier un utilisateur</h1>
            </div>

            <div class="content-grid">
                <div class="main-content">
                    <div class="info-card">
                        <div class="card-body">
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger"><?= $error ?></div>
                            <?php endif; ?>

                            <form method="POST" action="/srx/users/edit/<?= $user['id'] ?>" class="needs-validation" novalidate>
                                <div class="form-group">
                                    <label for="username">Nom d'utilisateur *</label>
                                    <input type="text" class="form-control" id="username" name="username" 
                                           value="<?= htmlspecialchars($user['username']) ?>" required>
                                    <div class="invalid-feedback">
                                        Le nom d'utilisateur est requis
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?= htmlspecialchars($user['email']) ?>" required>
                                    <div class="invalid-feedback">
                                        L'email est requis et doit être valide
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <div class="form-text">
                                        Laissez vide pour conserver le mot de passe actuel
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="role_id">Rôle *</label>
                                    <select class="form-control" id="role_id" name="role_id" required>
                                        <option value="">Sélectionnez un rôle</option>
                                        <?php foreach ($roles as $role): ?>
                                            <option value="<?= $role['id'] ?>" 
                                                    <?= $user['role_id'] == $role['id'] ? 'selected' : '' ?>>
                                                <?= ucfirst($role['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Le rôle est requis
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <a href="/srx/users" class="btn-action btn-return">
                                        <i class="fas fa-arrow-left"></i> Annuler
                                    </a>
                                    <button type="submit" class="btn-action btn-edit">
                                        <i class="fas fa-save"></i> Enregistrer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Aide et instructions -->
                <div class="sidebar">
                    <div class="info-card">
                        <div class="card-body">
                            <h5 class="section-title">Instructions</h5>
                            <p>
                                Les champs marqués d'un astérisque (*) sont obligatoires.
                            </p>
                            <ul class="info-list">
                                <li><i class="fas fa-info-circle"></i> Le mot de passe n'est modifié que s'il est renseigné</li>
                                <li><i class="fas fa-info-circle"></i> L'email doit être unique dans le système</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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
.user-edit-section {
    background: var(--background);
    min-height: 100vh;
    padding: 2rem 0;
}

/* En-tête */
.header-section {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    padding: 1.5rem;
    border-radius: 0.75rem;
    margin-bottom: 2rem;
    color: white;
}

.company-title {
    font-size: 1.75rem;
    margin: 0;
    font-weight: 600;
}

/* Grille de contenu */
.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
}

@media (max-width: 992px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
}

/* Cartes */
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
    padding: 1.5rem;
}

.section-title {
    font-size: 1.25rem;
    color: var(--primary-dark);
    margin-bottom: 1rem;
    font-weight: 600;
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
}

.form-control.is-invalid {
    border-color: var(--danger);
}

.invalid-feedback {
    color: var(--danger);
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.form-text {
    color: var(--text-secondary);
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

/* Actions du formulaire */
.form-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 2rem;
    gap: 1rem;
}

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
    background: var(--text-secondary);
    color: white;
}

.btn-edit {
    background: var(--primary);
    color: white;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-return:hover {
    background: #525252;
}

.btn-edit:hover {
    background: var(--primary-dark);
}

/* Liste d'informations */
.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    color: var(--text-primary);
}

.info-list i {
    color: var(--primary);
    font-size: 1rem;
}

/* Alertes */
.alert {
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
}

.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

/* Responsive */
@media (max-width: 768px) {
    .form-actions {
        flex-direction: column;
    }
    
    .btn-action {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
// Validation du formulaire (conservé tel quel)
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