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
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'student'): ?>
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
                                            <i class="bi bi-send"></i> Postuler
                                        </button>
                                    <?php else: ?>
                                        <button class="action-button applied-button" disabled>
                                            <i class="bi bi-check-circle"></i> Déjà postulé
                                        </button>
                                    <?php endif; ?>
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

    <!-- Modal de candidature -->
    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/srx/internships/apply/<?= $internship['id'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Postuler au stage</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="cv">CV (PDF uniquement)</label>
                            <input type="file" class="form-control" id="cv" name="cv" accept=".pdf" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message de motivation</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.internship-view {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.header-section {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    padding: 2rem;
    border-radius: 12px;
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

.internship-title {
    font-size: 2.2rem;
    margin: 0;
    color: white;
}

.btn-action {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn-edit {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.btn-edit:hover {
    background: rgba(255, 255, 255, 0.2);
}

.btn-return {
    background: transparent;
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.content-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}

@media (min-width: 992px) {
    .content-grid {
        grid-template-columns: 2fr 1fr;
    }
}

.info-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.card-content {
    padding: 1.5rem;
}

.section-title {
    color: #2c3e50;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.info-grid {
    display: grid;
    gap: 1rem;
    grid-template-columns: 1fr;
    margin-top: 1.5rem;
}

@media (min-width: 768px) {
    .info-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

.info-block {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    display: inline-block;
}

.status-success { background: #d4edda; color: #155724; }
.status-warning { background: #fff3cd; color: #856404; }
.status-danger { background: #f8d7da; color: #721c24; }

.student-actions {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #eee;
}

.action-group {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.action-button {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    border: none;
}

.apply-button {
    background: #28a745;
    color: white;
}

.applied-button {
    background: #6c757d;
    color: white;
}

.wishlist-button {
    background: #ffc107;
    color: black;
    padding: 0.75rem;
    border-radius: 50%;
}

.wishlist-button.active {
    background: #ffc107;
    color: black;
}

.company-name a {
    color: #3498db;
    text-decoration: none;
}

.contact-list {
    list-style: none;
    padding: 0;
}

.contact-list li {
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.stats-list {
    list-style: none;
    padding: 0;
}

.stats-list li {
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modal-content {
    border-radius: 12px;
    overflow: hidden;
}

.modal-header {
    background: #3498db;
    color: white;
    padding: 1rem;
}
</style>