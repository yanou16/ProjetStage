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
    /* Couleurs principales */
    --primary: #4f46e5;
    --primary-dark: #4338ca;
    --primary-light: #818cf8;
    --secondary: #3b82f6;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    
    /* Couleurs neutres */
    --gray-50: #f8fafc;
    --gray-100: #f1f5f9;
    --gray-200: #e2e8f0;
    --gray-300: #cbd5e1;
    --gray-400: #94a3b8;
    --gray-500: #64748b;
    --gray-600: #475569;
    --gray-700: #334155;
    --gray-800: #1e293b;
    --gray-900: #0f172a;
    
    /* Gradients */
    --gradient-primary: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    --gradient-hero: linear-gradient(to bottom, rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.9));
    
    /* Ombres */
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-md: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    
    /* Espacements */
    --spacing-1: 0.25rem;
    --spacing-2: 0.5rem;
    --spacing-3: 0.75rem;
    --spacing-4: 1rem;
    --spacing-6: 1.5rem;
    --spacing-8: 2rem;
    --spacing-12: 3rem;
    
    /* Bordures */
    --radius-sm: 0.25rem;
    --radius: 0.5rem;
    --radius-lg: 0.75rem;
    --radius-xl: 1rem;
    --radius-2xl: 1.5rem;
    --radius-full: 9999px;
    
    /* Transitions */
    --transition: all 0.3s ease;
    --transition-slow: all 0.5s ease;
    --transition-bounce: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Base */
body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    line-height: 1.5;
    color: var(--gray-700);
    background-color: var(--gray-50);
}

/* En-tête pleine largeur */
.full-width-header {
    position: relative;
    background: var(--gradient-primary);
    color: white;
    padding: var(--spacing-8) 0;
    margin-bottom: var(--spacing-8);
    overflow: hidden;
}

.full-width-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        linear-gradient(120deg, rgba(79, 70, 229, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%),
        radial-gradient(circle at 50% 50%, rgba(79, 70, 229, 0.15) 0%, transparent 50%);
    animation: gradientMove 15s ease infinite;
    z-index: 0;
}

.header-content {
    position: relative;
    z-index: 1;
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 var(--spacing-4);
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    animation: fadeInUp 0.8s ease;
}

.back-button {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-2);
    padding: var(--spacing-3) var(--spacing-6);
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border-radius: var(--radius);
    text-decoration: none;
    transition: var(--transition);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.back-button:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

/* Conteneur principal */
.main-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 var(--spacing-4);
}

.content-grid {
    display: grid;
    grid-template-columns: 3fr 1fr;
    gap: var(--spacing-8);
}

/* Cartes */
.info-card {
    background: white;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
    overflow: hidden;
    transition: var(--transition);
    animation: fadeInUp 0.8s ease;
}

.info-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
}

.card-body {
    padding: var(--spacing-6);
}

.section-title {
    font-size: 1.25rem;
    color: var(--gray-900);
    margin-bottom: var(--spacing-6);
    padding-bottom: var(--spacing-3);
    border-bottom: 2px solid var(--gray-200);
    font-weight: 600;
}

/* Formulaire */
.form-section {
    margin-bottom: var(--spacing-8);
    animation: fadeInUp 0.8s ease;
}

.form-group {
    margin-bottom: var(--spacing-6);
}

.form-group label {
    display: block;
    margin-bottom: var(--spacing-2);
    font-weight: 500;
    color: var(--gray-700);
}

.form-control {
    width: 100%;
    padding: var(--spacing-3) var(--spacing-4);
    border: 1px solid var(--gray-300);
    border-radius: var(--radius);
    font-size: 1rem;
    transition: var(--transition);
    background: var(--gray-50);
}

.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    outline: none;
    background: white;
}

.form-control:hover {
    border-color: var(--gray-400);
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--spacing-6);
}

textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

/* Validation */
.invalid-feedback {
    color: var(--danger);
    font-size: 0.875rem;
    margin-top: var(--spacing-2);
    display: none;
}

.was-validated .form-control:invalid {
    border-color: var(--danger);
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3E%3Ccircle cx='6' cy='6' r='4.5'/%3E%3Cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3E%3Ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.was-validated .form-control:invalid:focus {
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
}

.was-validated .form-control:invalid ~ .invalid-feedback {
    display: block;
}

/* Actions */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: var(--spacing-4);
    margin-top: var(--spacing-8);
    padding-top: var(--spacing-6);
    border-top: 1px solid var(--gray-200);
}

.btn-action {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-2);
    padding: var(--spacing-3) var(--spacing-6);
    border-radius: var(--radius);
    font-size: 0.875rem;
    font-weight: 500;
    transition: var(--transition);
    cursor: pointer;
}

.btn-submit {
    background: var(--gradient-primary);
    color: white;
    border: none;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4);
}

.btn-submit::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, 
        rgba(255,255,255,0) 0%, 
        rgba(255,255,255,0.1) 50%, 
        rgba(255,255,255,0) 100%
    );
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.btn-submit:hover::before {
    transform: translateX(100%);
}

/* Carte d'aide */
.help-card {
    position: sticky;
    top: var(--spacing-4);
}

.help-card .card-body {
    padding: var(--spacing-6);
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
    padding: var(--spacing-3) 0;
    color: var(--gray-600);
    border-bottom: 1px solid var(--gray-100);
    transition: var(--transition);
}

.info-list li:last-child {
    border-bottom: none;
}

.info-list li i {
    color: var(--primary);
    font-size: 1.25rem;
}

.info-list li:hover {
    color: var(--gray-900);
    transform: translateX(var(--spacing-2));
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes gradientMove {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

/* Responsive */
@media (max-width: 1024px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
    
    .help-card {
        position: static;
    }
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn-action {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 640px) {
    .header-content {
        flex-direction: column;
        gap: var(--spacing-4);
        text-align: center;
    }
    
    .back-button {
        width: 100%;
        justify-content: center;
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