<div class="company-create-section">
    <div class="header-section">
        <h1 class="company-title">Créer une offre de stage</h1>
    </div>

    <div class="container">
        <div class="content-grid">
            <div class="main-content">
                <div class="info-card">
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>

                        <form method="POST" action="/srx/internships/create" class="needs-validation" novalidate>
                            <!-- Informations générales -->
                            <div class="form-section">
                                <h5 class="section-title">Informations générales</h5>
                                <div class="form-group">
                                    <label for="title">Titre du stage *</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                    <div class="invalid-feedback">
                                        Le titre du stage est requis
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="company_id">Entreprise *</label>
                                    <select class="form-control" id="company_id" name="company_id" required>
                                        <option value="">Sélectionnez une entreprise</option>
                                        <?php foreach ($companies as $company): ?>
                                            <option value="<?= $company['id'] ?>"><?= htmlspecialchars($company['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        L'entreprise est requise
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description du stage *</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                                    <div class="invalid-feedback">
                                        La description du stage est requise
                                    </div>
                                </div>
                            </div>

                            <!-- Détails du stage -->
                            <div class="form-section">
                                <h5 class="section-title">Détails du stage</h5>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="start_date">Date de début *</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                        <div class="invalid-feedback">
                                            La date de début est requise
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="duration">Durée (en semaines) *</label>
                                        <input type="number" class="form-control" id="duration" name="duration" min="1" required>
                                        <div class="invalid-feedback">
                                            La durée est requise
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="skills_required">Compétences requises *</label>
                                    <textarea class="form-control" id="skills_required" name="skills_required" rows="3" required></textarea>
                                    <div class="invalid-feedback">
                                        Les compétences requises sont requises
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="compensation">Gratification (€/mois)</label>
                                    <input type="number" class="form-control" id="compensation" name="compensation" min="0" step="0.01">
                                    <div class="invalid-feedback">
                                        La gratification doit être un nombre positif
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <a href="/srx/internships" class="btn-action btn-cancel">
                                    <i class="fas fa-times"></i> Annuler
                                </a>
                                <button type="submit" class="btn-action btn-submit">
                                    <i class="fas fa-file-alt"></i> Publier l'offre
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
                            <li><i class="fas fa-info-circle"></i> Le titre doit être clair et concis</li>
                            <li><i class="fas fa-info-circle"></i> La description doit détailler les missions</li>
                            <li><i class="fas fa-info-circle"></i> Les compétences doivent être listées précisément</li>
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