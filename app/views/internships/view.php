<div class="internship-view">
    <div class="container">
        <div class="header-section">
            <div class="header-content">
                <h1 class="internship-title"><?= htmlspecialchars($internship['title']) ?></h1>
                <div class="header-actions">
                    <?php if (isset($_SESSION['user']) && ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'pilote')): ?>
                        <a href="/srx/internships/edit/<?= $internship['id'] ?>" class="btn-action btn-edit">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                    <?php endif; ?>
                    <a href="/srx/internships" class="btn-action btn-return">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>

        <div class="content-grid">
            <!-- Détails du stage -->
            <div class="main-content">
                <div class="info-card description-card">
                    <div class="card-content">
                        <h2 class="section-title">Description du poste</h2>
                        <p class="description-text"><?= nl2br(htmlspecialchars($internship['description'])) ?></p>

                        <h2 class="section-title skills-title">Compétences requises</h2>
                        <p class="skills-text"><?= nl2br(htmlspecialchars($internship['skills_required'])) ?></p>

                        <div class="info-grid">
                            <div class="info-block">
                                <h3>Informations pratiques</h3>
                                <ul class="info-list">
                                    <li>
                                        <i class="bi bi-calendar"></i>
                                        <span>Début: <?= (new DateTime($internship['start_date']))->format('d/m/Y') ?></span>
                                    </li>
                                    <li>
                                        <i class="bi bi-clock-history"></i>
                                        <span>Durée: <?= $internship['duration'] ?> semaines</span>
                                    </li>
                                    <?php if ($internship['compensation']): ?>
                                        <li>
                                            <i class="bi bi-currency-euro"></i>
                                            <span>Compensation: <?= number_format($internship['compensation'], 2, ',', ' ') ?> €</span>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="info-block">
                                <h3>Statut</h3>
                                <span class="status-badge <?= $internship['status'] === 'published' ? 'status-success' : ($internship['status'] === 'draft' ? 'status-warning' : 'status-danger') ?>">
                                    <?= ucfirst($internship['status']) ?>
                                </span>
                            </div>
                        </div>

                        <!-- Actions pour les étudiants -->
                        <?php if (isset($_SESSION['user']) && ($_SESSION['user']['role'] === 'student' || $_SESSION['user']['role'] === 'admin') && $_SESSION['user']['role'] !== 'pilote'): ?>
                            <div class="student-actions">
                                <div class="action-group">
                                    <!-- Wishlist -->
                                    <form action="/srx/internships/toggleWishlist/<?= $internship['id'] ?>" method="POST" class="d-inline">
                                        <button type="submit" class="action-button wishlist-button <?= $isInWishlist ? 'active' : '' ?>">
                                            <i class="bi bi-star<?= $isInWishlist ? '-fill' : '' ?>"></i>
                                        </button>
                                    </form>

                                    <!-- Postuler -->
                                    <?php if (!$hasApplied): ?>
                                        <button type="button" class="action-button apply-button" data-bs-toggle="modal" data-bs-target="#applyModal">
                                            <i class="bi bi-star"></i> <?= $isInWishlist ? 'Retirer de la wishlist' : 'Ajouter à la wishlist' ?>
                                        </button>
                                    <?php else: ?>
                                        <button class="action-button applied-button" disabled>
                                            <i class="bi bi-check-circle-fill"></i> Candidature envoyée
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Modal de candidature -->
                            <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="/srx/internships/apply/<?= $internship['id'] ?>" method="POST" enctype="multipart/form-data" class="application-form">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    <i class="bi bi-send-fill me-2"></i>
                                                    Postuler au stage
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-section">
                                                    <div class="form-group">
                                                        <label for="cv" class="form-label">
                                                            <i class="bi bi-file-earmark-pdf me-2"></i>
                                                            CV (PDF uniquement)
                                                        </label>
                                                        <div class="custom-file-upload">
                                                            <input type="file" class="form-control" id="cv" name="cv" accept=".pdf" required>
                                                            <div class="file-upload-text">
                                                                <i class="bi bi-cloud-arrow-up"></i>
                                                                Glissez votre CV ici ou cliquez pour sélectionner
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group mt-4">
                                                        <label for="message" class="form-label">
                                                            <i class="bi bi-chat-text me-2"></i>
                                                            Message de motivation
                                                        </label>
                                                        <textarea class="form-control custom-textarea" id="message" name="message" rows="6" required 
                                                                  placeholder="Présentez-vous et expliquez pourquoi ce stage vous intéresse..."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-lg"></i> Annuler
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-send-fill"></i> Envoyer ma candidature
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar Content -->
            <div class="sidebar-content">
                <!-- Informations entreprise -->
                <div class="info-card company-card">
                    <div class="card-content">
                        <h2 class="section-title">À propos de l'entreprise</h2>
                        <h3 class="company-name">
                            <a href="/srx/companies/view/<?= $company['id'] ?>">
                                <?= htmlspecialchars($company['name']) ?>
                            </a>
                        </h3>
                        <p class="company-description"><?= nl2br(htmlspecialchars(substr($company['description'], 0, 200))) ?>...</p>

                        <div class="contact-info">
                            <h3>Contact</h3>
                            <ul class="contact-list">
                                <?php if (!empty($company['email'])): ?>
                                    <li><i class="bi bi-envelope"></i> <?= htmlspecialchars($company['email']) ?></li>
                                <?php endif; ?>
                                <?php if (!empty($company['phone'])): ?>
                                    <li><i class="bi bi-telephone"></i> <?= htmlspecialchars($company['phone']) ?></li>
                                <?php endif; ?>
                                <?php if (!empty($company['website'])): ?>
                                    <li><i class="bi bi-globe"></i> <a href="<?= htmlspecialchars($company['website']) ?>" target="_blank">Site web</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <div class="location-info">
                            <h3>Localisation</h3>
                            <p class="location-text">
                                <i class="bi bi-geo-alt"></i>
                                <?= htmlspecialchars($company['address']) ?><br>
                                <?= htmlspecialchars($company['city']) ?>, <?= htmlspecialchars($company['country']) ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="info-card stats-card">
                    <div class="card-content">
                        <h2 class="section-title">Statistiques</h2>
                        <ul class="stats-list">
                            <li><i class="bi bi-clock"></i> Publié le <?= (new DateTime($internship['created_at']))->format('d/m/Y') ?></li>
                            <li><i class="bi bi-eye"></i> 0 vues</li>
                            <li><i class="bi bi-people"></i> 0 candidatures</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Menu Burger -->
<div class="burger-menu">
    <button class="burger-button" aria-label="Menu" aria-expanded="false">
        <span class="burger-line"></span>
        <span class="burger-line"></span>
        <span class="burger-line"></span>
    </button>
    <nav class="burger-nav" aria-hidden="true">
        <ul class="burger-links">
            <li><a href="/srx/internships" class="nav-link"><i class="bi bi-briefcase"></i><span>Stages</span></a></li>
            <li><a href="/srx/companies" class="nav-link"><i class="bi bi-building"></i><span>Entreprises</span></a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <?php if ($_SESSION['user']['role'] === 'student' || $_SESSION['user']['role'] === 'admin'): ?>
                    <li><a href="/srx/internships/my_applications" class="nav-link"><i class="bi bi-file-earmark-text"></i><span>Mes candidatures</span></a></li>
                    <li><a href="/srx/internships/my_wishlist" class="nav-link"><i class="bi bi-star"></i><span>Ma wishlist</span></a></li>
                <?php endif; ?>
                <li><a href="/srx/profile" class="nav-link"><i class="bi bi-person"></i><span>Mon profil</span></a></li>
                <li class="divider"></li>
                <li><a href="/srx/logout" class="nav-link logout-link"><i class="bi bi-box-arrow-right"></i><span>Déconnexion</span></a></li>
            <?php else: ?>
                <li><a href="/srx/login" class="nav-link"><i class="bi bi-box-arrow-in-right"></i><span>Connexion</span></a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="burger-overlay"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const burgerButton = document.querySelector('.burger-button');
    const burgerNav = document.querySelector('.burger-nav');
    const burgerOverlay = document.querySelector('.burger-overlay');
    
    // Gestion du clic sur le bouton burger
    burgerButton.addEventListener('click', function() {
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !isExpanded);
        burgerNav.setAttribute('aria-hidden', isExpanded);
        
        if (!isExpanded) {
            document.body.style.overflow = 'hidden';
            burgerOverlay.style.opacity = '1';
            burgerOverlay.style.visibility = 'visible';
        } else {
            document.body.style.overflow = '';
            burgerOverlay.style.opacity = '0';
            burgerOverlay.style.visibility = 'hidden';
        }
    });
    
    // Fermer le menu en cliquant sur l'overlay
    burgerOverlay.addEventListener('click', function() {
        burgerButton.setAttribute('aria-expanded', 'false');
        burgerNav.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        this.style.opacity = '0';
        this.style.visibility = 'hidden';
    });
    
    // Fermer le menu en appuyant sur Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && burgerNav.getAttribute('aria-hidden') === 'false') {
            burgerButton.setAttribute('aria-expanded', 'false');
            burgerNav.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            burgerOverlay.style.opacity = '0';
            burgerOverlay.style.visibility = 'hidden';
        }
    });
});
</script>

<style>
/* Variables globales */
:root {
    --primary-color: #2563eb;
    --primary-dark: #1d4ed8;
    --success-color: #059669;
    --success-dark: #047857;
    --warning-color: #f59e0b;
    --danger-color: #dc2626;
    --text-primary: #1f2937;
    --text-secondary: #4b5563;
    --bg-gradient: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    --hover-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Styles de base améliorés */
.internship-view {
    background: var(--bg-gradient);
    min-height: 100vh;
    padding: 2rem 0;
    color: var(--text-primary);
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* En-tête amélioré */
.header-section {
    background: linear-gradient(135deg, #1a365d 0%, #2563eb 100%);
    padding: 2.5rem;
    border-radius: 16px;
    margin-bottom: 2.5rem;
    color: white;
    box-shadow: 0 4px 20px rgba(37, 99, 235, 0.2);
    position: relative;
    overflow: hidden;
}

.header-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
    pointer-events: none;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1.5rem;
    position: relative;
    z-index: 1;
}

.internship-title {
    font-size: 2.5rem;
    margin: 0;
    color: white;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    line-height: 1.2;
}

/* Grille de contenu améliorée */
.content-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2.5rem;
    margin-top: 2rem;
}

@media (min-width: 992px) {
    .content-grid {
        grid-template-columns: 2fr 1fr;
    }
}

/* Cartes d'information améliorées */
.info-card {
    background: white;
    border-radius: 16px;
    box-shadow: var(--card-shadow);
    margin-bottom: 2rem;
    overflow: hidden;
    transition: var(--transition);
    border: 1px solid rgba(0,0,0,0.05);
}

.info-card:hover {
    box-shadow: var(--hover-shadow);
    transform: translateY(-2px);
}

.card-content {
    padding: 2rem;
}

.section-title {
    color: var(--text-primary);
    font-size: 1.75rem;
    margin-bottom: 1.5rem;
    font-weight: 700;
    position: relative;
    padding-bottom: 0.75rem;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 4px;
    background: var(--primary-color);
    border-radius: 2px;
}

/* Grille d'informations améliorée */
.info-grid {
    display: grid;
    gap: 1.5rem;
    grid-template-columns: 1fr;
    margin-top: 2rem;
}

@media (min-width: 768px) {
    .info-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

.info-block {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    padding: 1.5rem;
    border-radius: 12px;
    border: 1px solid rgba(0,0,0,0.05);
    transition: var(--transition);
}

.info-block:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    transform: translateY(-2px);
}

/* Badges de statut améliorés */
.status-badge {
    padding: 0.625rem 1.25rem;
    border-radius: 25px;
    font-size: 0.95rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: var(--transition);
}

.status-success { 
    background: #ecfdf5; 
    color: #059669;
    border: 1px solid #34d399;
}

.status-warning { 
    background: #fffbeb; 
    color: #d97706;
    border: 1px solid #fbbf24;
}

.status-danger { 
    background: #fef2f2; 
    color: #dc2626;
    border: 1px solid #f87171;
}

/* Actions des étudiants améliorées */
.student-actions {
    margin-top: 2.5rem;
    padding: 2rem;
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.1);
    border: 1px solid rgba(37, 99, 235, 0.1);
    position: relative;
    overflow: hidden;
}

.student-actions::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 100%);
    pointer-events: none;
}

.action-group {
    display: flex;
    gap: 1.5rem;
    align-items: center;
    justify-content: flex-start;
    position: relative;
    z-index: 1;
}

/* Boutons d'action améliorés */
.action-button {
    padding: 0.875rem 1.75rem;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    gap: 0.875rem;
    transition: var(--transition);
    border: none;
    font-weight: 600;
    font-size: 1.05rem;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.action-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
    transition: var(--transition);
}

.apply-button {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
}

.apply-button:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
}

.apply-button:hover::before {
    opacity: 0.2;
}

.applied-button {
    background: linear-gradient(135deg, var(--success-color) 0%, var(--success-dark) 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);
}

.wishlist-button {
    background: white;
    color: var(--warning-color);
    padding: 0.875rem;
    width: 3.5rem;
    height: 3.5rem;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border: 2px solid var(--warning-color);
    display: flex;
    align-items: center;
    justify-content: center;
}

.wishlist-button:hover {
    background: var(--warning-color);
    color: white;
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 6px 15px rgba(245, 158, 11, 0.3);
}

.wishlist-button.active {
    background: var(--warning-color);
    color: white;
    animation: pulse 1.5s infinite;
}

/* Modal amélioré */
.modal-dialog {
    max-width: 800px;
}

.modal-content {
    border: none;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    overflow: hidden;
}

.modal-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: white;
    padding: 2rem;
    border-bottom: none;
    position: relative;
    overflow: hidden;
}

.modal-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
    pointer-events: none;
}

.modal-title {
    font-size: 1.75rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
    z-index: 1;
}

.modal-body {
    padding: 2.5rem;
}

/* Formulaire amélioré */
.form-section {
    max-width: 100%;
}

.form-label {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    font-size: 1.1rem;
}

.custom-file-upload {
    position: relative;
    border: 2px dashed #d1d5db;
    border-radius: 16px;
    padding: 2.5rem;
    text-align: center;
    transition: var(--transition);
    background: #f9fafb;
    cursor: pointer;
}

.custom-file-upload:hover {
    border-color: var(--primary-color);
    background: #f0f9ff;
    transform: translateY(-2px);
}

.custom-file-upload input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.file-upload-text {
    color: var(--text-secondary);
    font-size: 1.1rem;
}

.file-upload-text i {
    font-size: 2.5rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
    display: block;
    transition: var(--transition);
}

.custom-file-upload:hover .file-upload-text i {
    transform: translateY(-5px);
}

.custom-textarea {
    border: 2px solid #e5e7eb;
    border-radius: 16px;
    padding: 1.25rem;
    font-size: 1.05rem;
    transition: var(--transition);
    resize: vertical;
    min-height: 150px;
}

.custom-textarea:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    outline: none;
}

.modal-footer {
    border-top: none;
    padding: 2rem 2.5rem;
    gap: 1rem;
    background: #f8fafc;
}

/* Boutons améliorés */
.btn {
    padding: 0.875rem 1.75rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1.05rem;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
    opacity: 0;
    transition: var(--transition);
}

.btn:hover::before {
    opacity: 1;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    border: none;
    color: white;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
}

.btn-primary:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
}

.btn-outline-secondary {
    border: 2px solid #d1d5db;
    background: white;
    color: var(--text-secondary);
}

.btn-outline-secondary:hover {
    background: #f3f4f6;
    border-color: #9ca3af;
    color: var(--text-primary);
    transform: translateY(-2px);
}

/* Animations */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

/* Responsive Design amélioré */
@media (max-width: 768px) {
    .header-section {
        padding: 1.5rem;
    }

    .internship-title {
        font-size: 2rem;
    }

    .content-grid {
        gap: 1.5rem;
    }

    .card-content {
        padding: 1.5rem;
    }

    .action-group {
        flex-direction: column;
        align-items: stretch;
    }
    
    .action-button {
        width: 100%;
        justify-content: center;
    }
    
    .wishlist-button {
        width: 3.5rem;
        align-self: center;
    }
    
    .modal-dialog {
        margin: 0.5rem;
    }
    
    .modal-body {
        padding: 1.5rem;
    }

    .custom-file-upload {
        padding: 1.5rem;
    }
}

/* Effets de survol et transitions supplémentaires */
.info-card .card-content,
.custom-textarea,
.custom-file-upload,
.btn,
.action-button {
    will-change: transform, box-shadow;
}

.modal-content {
    animation: modalFadeIn 0.3s ease-out;
}

@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Menu Burger amélioré */
.burger-menu {
    display: none;
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
}

.burger-button {
    width: 56px;
    height: 56px;
    background: var(--primary-color);
    border: none;
    border-radius: 16px;
    padding: 16px;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    z-index: 1001;
    position: relative;
}

.burger-button:hover {
    transform: scale(1.05);
    background: var(--primary-dark);
    box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
}

.burger-button[aria-expanded="true"] {
    background: var(--danger-color);
}

.burger-line {
    width: 24px;
    height: 3px;
    background: white;
    border-radius: 3px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    transform-origin: center;
}

.burger-button[aria-expanded="true"] .burger-line:nth-child(1) {
    transform: translateY(10px) rotate(45deg);
}

.burger-button[aria-expanded="true"] .burger-line:nth-child(2) {
    opacity: 0;
    transform: scaleX(0);
}

.burger-button[aria-expanded="true"] .burger-line:nth-child(3) {
    transform: translateY(-10px) rotate(-45deg);
}

.burger-nav {
    position: fixed;
    top: 0;
    right: -320px;
    width: 320px;
    height: 100vh;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    padding: 100px 24px 40px;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: -5px 0 30px rgba(0, 0, 0, 0.15);
    border-left: 1px solid rgba(0, 0, 0, 0.05);
    z-index: 1000;
    overflow-y: auto;
}

.burger-nav[aria-hidden="false"] {
    right: 0;
}

.burger-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    z-index: 999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.burger-menu.active .burger-overlay {
    opacity: 1;
    visibility: visible;
}

.burger-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.burger-links li {
    opacity: 0;
    transform: translateX(30px);
    transition: all 0.4s ease;
}

.burger-links li.divider {
    height: 1px;
    background: rgba(0, 0, 0, 0.1);
    margin: 16px 0;
    transform: none;
}

.burger-nav[aria-hidden="false"] .burger-links li {
    opacity: 1;
    transform: translateX(0);
}

.burger-nav[aria-hidden="false"] .burger-links li:nth-child(1) { transition-delay: 0.1s; }
.burger-nav[aria-hidden="false"] .burger-links li:nth-child(2) { transition-delay: 0.15s; }
.burger-nav[aria-hidden="false"] .burger-links li:nth-child(3) { transition-delay: 0.2s; }
.burger-nav[aria-hidden="false"] .burger-links li:nth-child(4) { transition-delay: 0.25s; }
.burger-nav[aria-hidden="false"] .burger-links li:nth-child(5) { transition-delay: 0.3s; }
.burger-nav[aria-hidden="false"] .burger-links li:nth-child(6) { transition-delay: 0.35s; }

.nav-link {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px 20px;
    color: var(--text-primary);
    text-decoration: none;
    font-weight: 500;
    border-radius: 12px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    margin: 4px 0;
}

.nav-link:hover {
    background: rgba(37, 99, 235, 0.1);
    transform: translateX(4px);
}

.nav-link i {
    font-size: 1.25rem;
    color: var(--primary-color);
    width: 24px;
    text-align: center;
}

.nav-link span {
    flex: 1;
}

.logout-link {
    color: var(--danger-color);
    background: rgba(220, 38, 38, 0.05);
}

.logout-link i {
    color: var(--danger-color);
}

.logout-link:hover {
    background: rgba(220, 38, 38, 0.1);
}

@media (max-width: 992px) {
    .burger-menu {
        display: block;
    }
    
    /* Ajustement du header pour le menu burger */
    .header-section {
        padding-right: 90px;
    }
}

/* Animation d'apparition */
@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
</style>