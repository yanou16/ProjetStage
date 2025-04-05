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

<div class="geometric-shapes">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
</div>

<style>
/* Variables */
:root {
    --primary: #4F46E5;
    --primary-dark: #4338CA;
    --primary-light: #818CF8;
    --background: #f8fafc;
    --text-primary: #1F2937;
    --text-secondary: #4B5563;
    --border: #E2E8F0;
    --danger: #EF4444;
    --success: #10B981;
    --gradient-primary: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
    --shadow-input: 0 2px 4px rgba(79, 70, 229, 0.1);
    --glow-primary: 0 0 20px rgba(79, 70, 229, 0.15);
}

/* Structure générale */
.company-create-section {
    background: var(--background);
    min-height: 100vh;
    padding-bottom: 4rem;
    position: relative;
    overflow: hidden;
}

/* Effet de background animé */
.company-create-section::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 100vh;
    background: 
        radial-gradient(circle at 15% 50%, rgba(79, 70, 229, 0.1) 0%, transparent 25%),
        radial-gradient(circle at 85% 30%, rgba(129, 140, 248, 0.1) 0%, transparent 25%),
        linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    transform: skewY(-3deg);
    transform-origin: 0;
    z-index: 0;
    animation: gradientMove 15s ease-in-out infinite;
}

/* Particules d'arrière-plan */
.company-create-section::after {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 50% 50%, white 1px, transparent 1px),
        radial-gradient(circle at 50% 50%, white 1px, transparent 1px);
    background-size: 40px 40px;
    background-position: 0 0, 20px 20px;
    opacity: 0.03;
    z-index: 0;
    animation: particlesFloat 20s linear infinite;
}

/* Formes géométriques flottantes */
.geometric-shapes {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 0;
    overflow: hidden;
    pointer-events: none;
}

.shape {
    position: absolute;
    opacity: 0.1;
    animation: shapeFloat 20s infinite linear;
}

.shape-1 {
    top: 20%;
    left: 10%;
    width: 100px;
    height: 100px;
    border: 2px solid var(--primary-light);
    border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
    animation-duration: 15s;
}

.shape-2 {
    top: 60%;
    right: 15%;
    width: 150px;
    height: 150px;
    background: var(--primary-light);
    clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
    animation-duration: 25s;
    animation-delay: -5s;
}

.shape-3 {
    bottom: 20%;
    left: 20%;
    width: 80px;
    height: 80px;
    background: var(--primary);
    border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%;
    animation-duration: 20s;
    animation-delay: -10s;
}

/* Animations */
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

@keyframes particlesFloat {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-40px);
    }
}

@keyframes shapeFloat {
    0% {
        transform: translate(0, 0) rotate(0deg);
    }
    33% {
        transform: translate(30px, -30px) rotate(120deg);
    }
    66% {
        transform: translate(-30px, 30px) rotate(240deg);
    }
    100% {
        transform: translate(0, 0) rotate(360deg);
    }
}

/* Effet de glassmorphisme amélioré */
.info-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 
        0 8px 32px rgba(79, 70, 229, 0.1),
        inset 0 0 0 1px rgba(255, 255, 255, 0.5);
}

.info-card:hover {
    background: rgba(255, 255, 255, 0.98);
    box-shadow: 
        0 12px 40px rgba(79, 70, 229, 0.15),
        inset 0 0 0 1px rgba(255, 255, 255, 0.6);
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    position: relative;
    z-index: 1;
}

.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    margin-top: -60px;
}

/* En-tête */
.header-section {
    background: transparent;
    padding: 2rem 0;
    margin-bottom: 2rem;
    color: white;
    text-align: center;
    position: relative;
    z-index: 1;
}

.company-title {
    font-size: 2.5rem;
    margin: 0;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    animation: fadeInDown 0.6s ease-out;
}

/* Cartes */
.info-card {
    background: white;
    border-radius: 1rem;
    box-shadow: var(--shadow-md);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    animation: slideUp 0.6s ease-out;
}

.info-card:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-2px);
}

.card-body {
    padding: 2rem;
}

.section-title {
    font-size: 1.5rem;
    color: var(--primary);
    margin-bottom: 2rem;
    font-weight: 600;
    position: relative;
    padding-bottom: 0.75rem;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: var(--gradient-primary);
    border-radius: 3px;
}

/* Formulaire */
.form-section {
    margin-bottom: 2.5rem;
    animation: fadeIn 0.6s ease-out;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--text-primary);
    font-weight: 500;
    font-size: 0.95rem;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid var(--border);
    border-radius: 0.75rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
    color: var(--text-primary);
    box-shadow: var(--shadow-input);
}

.form-control:focus {
    border-color: var(--primary-light);
    box-shadow: var(--glow-primary);
    outline: none;
}

.form-control:hover {
    border-color: var(--primary-light);
}

textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

/* Boutons */
.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border);
}

.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 0.75rem;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
}

.btn-submit {
    background: var(--gradient-primary);
    color: white;
    border: none;
    box-shadow: var(--shadow-md);
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.btn-cancel {
    background: white;
    color: var(--text-secondary);
    border: 1px solid var(--border);
}

.btn-cancel:hover {
    background: var(--background);
    color: var(--text-primary);
}

/* Sidebar */
.sidebar .info-card {
    position: sticky;
    top: 2rem;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 0;
    color: var(--text-secondary);
    border-bottom: 1px solid var(--border);
}

.info-list li:last-child {
    border-bottom: none;
}

.info-list li i {
    color: var(--primary);
    font-size: 1.25rem;
}

/* Validation et alertes */
.invalid-feedback {
    display: none;
    color: var(--danger);
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.form-control.is-invalid {
    border-color: var(--danger);
}

.form-control.is-invalid + .invalid-feedback {
    display: block;
}

.alert {
    padding: 1rem;
    border-radius: 0.75rem;
    margin-bottom: 1.5rem;
    animation: shake 0.5s ease-in-out;
}

.alert-danger {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
    color: var(--danger);
}

/* Animations */
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

/* Responsive */
@media (max-width: 992px) {
    .content-grid {
        grid-template-columns: 1fr;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .company-title {
        font-size: 2rem;
    }

    .container {
        padding: 0 1rem;
    }

    .card-body {
        padding: 1.5rem;
    }
}

@media (max-width: 768px) {
    .company-title {
        font-size: 1.75rem;
    }

    .btn-action {
        width: 100%;
        justify-content: center;
    }

    .form-actions {
        flex-direction: column-reverse;
    }
}

/* Effets de hover sur les select */
select.form-control {
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%234B5563'%3E%3Cpath d='M7 10l5 5 5-5H7z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 1.5em;
    padding-right: 2.5rem;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

/* Personnalisation des placeholder */
::placeholder {
    color: var(--text-secondary);
    opacity: 0.7;
}

/* Effet de focus visible */
.form-control:focus-visible {
    outline: 2px solid var(--primary-light);
    outline-offset: 1px;
}

/* Effet de transition sur les inputs */
.form-control {
    transition: all 0.2s ease;
}

/* Style des scrollbars */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: var(--background);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: var(--primary-light);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--primary);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des sections au scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.form-section').forEach(section => {
        observer.observe(section);
    });

    // Validation personnalisée du formulaire
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });

    // Animation des inputs au focus
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.closest('.form-group').classList.add('focused');
        });

        input.addEventListener('blur', function() {
            if (!this.value) {
                this.closest('.form-group').classList.remove('focused');
            }
        });
    });
});
</script>