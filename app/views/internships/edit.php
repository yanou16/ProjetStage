<div class="dashboard-section">
    <div class="container-fluid px-0">
        <div class="row">
            <main class="col-12 px-0">
                <!-- En-tête pleine largeur -->
                <div class="full-width-header">
                    <div class="container-fluid">
                        <div class="header-content">
                            <h1 class="page-title">Modifier l'offre de stage</h1>
                            <a href="/srx/internships" class="back-button">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contenu principal -->
                <div class="container-fluid main-container py-4">
                    <div class="content-grid">
                        <!-- Formulaire -->
                        <div class="main-content">
                            <div class="info-card">
                                <div class="card-body">
                                    <?php if (isset($error)): ?>
                                        <div class="alert alert-danger"><?= $error ?></div>
                                    <?php endif; ?>

                                    <form method="POST" action="/srx/internships/edit/<?= $internship['id'] ?>" class="needs-validation" novalidate>
                                        <!-- Section Informations générales -->
                                        <div class="form-section">
                                            <h5 class="section-title">Informations générales</h5>
                                            
                                            <div class="form-group">
                                                <label for="title">Titre du stage *</label>
                                                <input type="text" class="form-control" id="title" name="title" 
                                                    value="<?= htmlspecialchars($internship['title']) ?>" required>
                                                <div class="invalid-feedback">
                                                    Le titre du stage est requis
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="company_id">Entreprise *</label>
                                                <select class="form-control" id="company_id" name="company_id" required>
                                                    <option value="">Sélectionnez une entreprise</option>
                                                    <?php foreach ($companies as $company): ?>
                                                        <option value="<?= $company['id'] ?>" 
                                                            <?= $company['id'] == $internship['company_id'] ? 'selected' : '' ?>>
                                                            <?= htmlspecialchars($company['name']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    L'entreprise est requise
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description du stage *</label>
                                                <textarea class="form-control" id="description" name="description" 
                                                        rows="4" required><?= htmlspecialchars($internship['description']) ?></textarea>
                                                <div class="invalid-feedback">
                                                    La description du stage est requise
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Section Détails du stage -->
                                        <div class="form-section">
                                            <h5 class="section-title">Détails du stage</h5>
                                            
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label for="start_date">Date de début *</label>
                                                    <input type="date" class="form-control" id="start_date" name="start_date" 
                                                        value="<?= $internship['start_date'] ?>" required>
                                                    <div class="invalid-feedback">
                                                        La date de début est requise
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="duration">Durée (semaines) *</label>
                                                    <input type="number" class="form-control" id="duration" name="duration" 
                                                        min="1" value="<?= $internship['duration'] ?>" required>
                                                    <div class="invalid-feedback">
                                                        La durée est requise
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="skills_required">Compétences requises *</label>
                                                <textarea class="form-control" id="skills_required" name="skills_required" 
                                                        rows="3" required><?= htmlspecialchars($internship['skills_required']) ?></textarea>
                                                <div class="invalid-feedback">
                                                    Les compétences requises sont requises
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="compensation">Compensation (€/mois)</label>
                                                <input type="number" class="form-control" id="compensation" name="compensation" 
                                                    min="0" step="0.01" value="<?= $internship['compensation'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="submit" class="btn-action btn-submit">
                                                <i class="fas fa-save"></i> Enregistrer les modifications
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="sidebar">
                            <div class="info-card help-card">
                                <div class="card-body">
                                    <h5 class="section-title">Instructions</h5>
                                    <ul class="info-list">
                                        <li><i class="fas fa-info-circle"></i> Champs obligatoires (*)</li>
                                        <li><i class="fas fa-info-circle"></i> Description claire et détaillée</li>
                                        <li><i class="fas fa-info-circle"></i> Compétences spécifiques</li>
                                        <li><i class="fas fa-info-circle"></i> Durée en semaines</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
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
    --white: #ffffff;
}

/* Base */
body {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    background-color: var(--background);
    color: var(--text-primary);
    line-height: 1.6;
}

/* En-tête pleine largeur */
.full-width-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: var(--white);
    width: 100vw;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;
    padding: 1rem 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
}

.page-title {
    font-size: 1.75rem;
    margin: 0;
    font-weight: 600;
}

.back-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.7rem 1.2rem;
    background-color: rgba(255, 255, 255, 0.15);
    color: var(--white);
    border-radius: 0.5rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.back-button:hover {
    background-color: rgba(255, 255, 255, 0.25);
    transform: translateY(-1px);
}

/* Conteneur principal */
.main-container {
    max-width: 1400px;
    margin: 2rem auto;
    padding: 0 2rem;
}

.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
}

/* Cartes */
.info-card {
    background: var(--white);
    border-radius: 0.75rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    border: 1px solid var(--border);
    margin-bottom: 1.5rem;
}

.card-body {
    padding: 2rem;
}

.section-title {
    font-size: 1.25rem;
    color: var(--primary-dark);
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--border);
    font-weight: 600;
}

/* Formulaire */
.form-section {
    margin-bottom: 2.5rem;
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
    transition: all 0.2s ease;
}

.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    outline: none;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

/* Validation */
.invalid-feedback {
    color: var(--danger);
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: none;
}

.was-validated .form-control:invalid ~ .invalid-feedback {
    display: block;
}

.was-validated .form-control:invalid {
    border-color: var(--danger);
}

/* Boutons */
.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.8rem 1.5rem;
    border: none;
    border-radius: 0.5rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-submit {
    background: var(--primary);
    color: var(--white);
}

.btn-submit:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

/* Instructions */
.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    display: flex;
    align-items: center;
    gap: 0.8rem;
    margin-bottom: 1rem;
    color: var(--text-secondary);
}

.info-list i {
    color: var(--primary);
    min-width: 1.25rem;
}

/* Responsive */
@media (max-width: 992px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
    
    .main-container {
        padding: 0 1.5rem;
    }
}

@media (max-width: 768px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .back-button {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .card-body {
        padding: 1.5rem;
    }
}
</style>

<script>
// Validation du formulaire
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms).forEach(function (form) {
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