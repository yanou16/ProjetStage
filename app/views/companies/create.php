<?php
if (isset($data)) {
    extract($data);
}
?>

<div class="company-create-section">
    <div class="header-section">
        <h1 class="company-title">Créer une entreprise</h1>
    </div>

    <div class="container">
        <div class="content-grid">
            <div class="main-content">
                <div class="info-card">
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>

                        <form method="POST" action="/srx/companies/create" class="needs-validation" novalidate>
                            <!-- Informations générales -->
                            <div class="form-section">
                                <h5 class="section-title">Informations générales</h5>
                                <div class="form-group">
                                    <label for="name">Nom de l'entreprise *</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    <div class="invalid-feedback">
                                        Le nom de l'entreprise est requis
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="industry">Secteur d'activité *</label>
                                    <select class="form-control" id="industry" name="industry" required>
                                        <option value="">Sélectionnez un secteur</option>
                                        <option value="Technology">Technologies</option>
                                        <option value="Finance">Finance</option>
                                        <option value="Healthcare">Santé</option>
                                        <option value="Education">Éducation</option>
                                        <option value="Manufacturing">Industrie</option>
                                        <option value="Retail">Commerce</option>
                                        <option value="Services">Services</option>
                                        <option value="Other">Autre</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Veuillez sélectionner un secteur d'activité
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description de l'entreprise *</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                                    <div class="invalid-feedback">
                                        Une description de l'entreprise est requise
                                    </div>
                                </div>
                            </div>

                            <!-- Localisation -->
                            <div class="form-section">
                                <h5 class="section-title">Localisation</h5>
                                <div class="form-group">
                                    <label for="address">Adresse *</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                    <div class="invalid-feedback">
                                        L'adresse est requise
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="city">Ville *</label>
                                        <input type="text" class="form-control" id="city" name="city" required>
                                        <div class="invalid-feedback">
                                            La ville est requise
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="country">Pays *</label>
                                        <select class="form-control" id="country" name="country" required>
                                            <option value="">Sélectionnez un pays</option>
                                            <option value="FR">France</option>
                                            <option value="BE">Belgique</option>
                                            <option value="CH">Suisse</option>
                                            <option value="LU">Luxembourg</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Le pays est requis
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="form-section">
                                <h5 class="section-title">Informations de contact</h5>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    <div class="invalid-feedback">
                                        Veuillez entrer une adresse email valide
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Téléphone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{10}">
                                    <div class="invalid-feedback">
                                        Veuillez entrer un numéro de téléphone valide
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="website">Site web</label>
                                    <input type="url" class="form-control" id="website" name="website">
                                    <div class="invalid-feedback">
                                        Veuillez entrer une URL valide
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <a href="/srx/companies" class="btn-action btn-cancel">
                                    <i class="fas fa-times"></i> Annuler
                                </a>
                                <button type="submit" class="btn-action btn-submit">
                                    <i class="fas fa-building"></i> Créer l'entreprise
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
                            <li><i class="fas fa-info-circle"></i> Le nom de l'entreprise doit être unique</li>
                            <li><i class="fas fa-info-circle"></i> La description doit être concise et informative</li>
                            <li><i class="fas fa-info-circle"></i> L'adresse sera utilisée pour la géolocalisation</li>
                        </ul>
                    </div>
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
.company-create-section {
    background: var(--background);
    min-height: 100vh;
    padding-bottom: 2rem;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

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

/* En-tête */
.header-section {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    padding: 1.5rem;
    margin-bottom: 2rem;
    color: white;
    border-radius: 0 0 1rem 1rem;
}

.company-title {
    font-size: 1.75rem;
    margin: 0;
    font-weight: 600;
    text-align: center;
}

/* Cartes */
.info-card {
    background: white;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: 1px solid var(--border);
    transition: all 0.3s ease;
    margin-bottom: 2rem;
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
    margin-bottom: 1.5rem;
    font-weight: 600;
    border-bottom: 2px solid var(--border);
    padding-bottom: 0.5rem;
}

/* Formulaire */
.form-section {
    margin-bottom: 2.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--border);
}

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

.was-validated .form-control:invalid ~ .invalid-feedback {
    display: block;
}

textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
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
    width: 1.25rem;
    text-align: center;
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

.btn-cancel {
    background: var(--text-secondary);
    color: white;
}

.btn-submit {
    background: var(--primary);
    color: white;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-cancel:hover {
    background: #525252;
}

.btn-submit:hover {
    background: var(--primary-dark);
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
</style>

<script>
// Validation du formulaire côté client
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