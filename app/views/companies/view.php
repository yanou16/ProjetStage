<div class="company-view">
    <div class="container">
        <!-- En-tête -->
        <div class="header-section">
            <div class="header-content">
                <h1 class="company-title"><?= htmlspecialchars($company['name']) ?></h1>
                <div class="header-actions">
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                        <a href="/srx/companies/edit/<?= $company['id'] ?>" class="btn-action btn-edit">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                    <?php endif; ?>
                    <a href="/srx/companies" class="btn-action btn-return">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="content-grid">
            <!-- Colonne gauche -->
            <div class="main-content">
                <!-- Carte Informations générales -->
                <div class="info-card">
                    <div class="card-body">
                        <h2 class="section-title">Informations générales</h2>
                        <div class="info-columns">
                            <div class="info-block">
                                <ul class="info-list">
                                    <li>
                                        <i class="bi bi-building"></i>
                                        <span><?= htmlspecialchars($company['industry'] ?? 'Non spécifié') ?></span>
                                    </li>
                                    <li>
                                        <i class="bi bi-envelope"></i>
                                        <span><?= htmlspecialchars($company['email'] ?? 'Non spécifié') ?></span>
                                    </li>
                                    <li>
                                        <i class="bi bi-telephone"></i>
                                        <span><?= htmlspecialchars($company['phone'] ?? 'Non spécifié') ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="info-block">
                                <ul class="info-list">
                                    <li>
                                        <i class="bi bi-geo-alt"></i>
                                        <span><?= htmlspecialchars($company['address'] ?? 'Non spécifié') ?></span>
                                    </li>
                                    <li>
                                        <i class="bi bi-building"></i>
                                        <span><?= htmlspecialchars($company['city'] ?? 'Non spécifié') ?></span>
                                    </li>
                                    <li>
                                        <i class="bi bi-globe"></i>
                                        <span><?= htmlspecialchars($company['country'] ?? 'Non spécifié') ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php if (!empty($company['website'])): ?>
                            <div class="website-link">
                                <i class="bi bi-link-45deg"></i>
                                <a href="<?= htmlspecialchars($company['website']) ?>" target="_blank">
                                    <?= htmlspecialchars($company['website']) ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($company['description'])): ?>
                            <div class="description-section">
                                <h3>À propos</h3>
                                <p><?= nl2br(htmlspecialchars($company['description'])) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Liste des stages -->
                <div class="info-card">
                    <div class="card-body">
                        <h2 class="section-title">Stages proposés</h2>
                        <?php if (!empty($internships)): ?>
                            <div class="internship-list">
                                <?php foreach ($internships as $internship): ?>
                                    <a href="/srx/internships/view/<?= $internship['id'] ?>" class="internship-item">
                                        <div class="internship-header">
                                            <h3><?= htmlspecialchars($internship['title']) ?></h3>
                                            <span class="date">
                                                <?= (new DateTime($internship['created_at']))->format('d/m/Y') ?>
                                            </span>
                                        </div>
                                        <p><?= htmlspecialchars(substr($internship['description'], 0, 150)) ?>...</p>
                                        <div class="internship-meta">
                                            <span><i class="bi bi-clock"></i> <?= $internship['duration'] ?> semaines</span>
                                            <span><i class="bi bi-calendar"></i> <?= (new DateTime($internship['start_date']))->format('d/m/Y') ?></span>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="bi bi-briefcase"></i>
                                <p>Aucun stage disponible</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Colonne droite -->
            <div class="sidebar-content">
                <!-- Carte Localisation -->
                <div class="info-card">
                    <div class="card-body">
                        <h2 class="section-title">Localisation</h2>
                        <?php if (!empty($company['address']) && !empty($company['city'])): ?>
                            <div class="map-container">
                                <iframe 
                                    src="https://maps.google.com/maps?q=<?= urlencode($company['address'] . ', ' . $company['city']) ?>&output=embed">
                                </iframe>
                            </div>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="bi bi-map"></i>
                                <p>Adresse non disponible</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="info-card">
                    <div class="card-body">
                        <h2 class="section-title">Statistiques</h2>
                        <ul class="stats-list">
                            <li>
                                <i class="bi bi-briefcase"></i>
                                <span><?= count($internships) ?> stage(s)</span>
                            </li>
                            <li>
                                <i class="bi bi-calendar"></i>
                                <span>Membre depuis <?= (new DateTime($company['created_at']))->format('d/m/Y') ?></span>
                            </li>
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
}

/* Structure de base */
.company-view {
    background: var(--background);
    min-height: 100vh;
    padding: 2rem 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* En-tête */
.header-section {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    padding: 2rem;
    border-radius: 1rem;
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
    font-size: 2rem;
    margin: 0;
}

/* Grille de contenu */
.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
}

/* Cartes */
.info-card {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
    border: 1px solid var(--border);
}

.card-body {
    padding: 1.5rem;
}

.section-title {
    font-size: 1.5rem;
    color: var(--primary-dark);
    margin-bottom: 1.5rem;
}

/* Colonnes d'information */
.info-columns {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
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
    margin-bottom: 1rem;
    color: var(--text-primary);
}

.info-list i {
    color: var(--text-secondary);
    font-size: 1.2rem;
}

/* Liste des stages */
.internship-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.internship-item {
    padding: 1rem;
    border-radius: 0.75rem;
    background: var(--background);
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
}

.internship-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.internship-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

.internship-header h3 {
    margin: 0;
    font-size: 1.1rem;
}

.date {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.internship-meta {
    display: flex;
    gap: 1.5rem;
    color: var(--text-secondary);
    font-size: 0.9rem;
}

/* Carte de localisation */
.map-container {
    position: relative;
    padding-bottom: 75%;
    border-radius: 0.75rem;
    overflow: hidden;
}

.map-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

/* Statistiques */
.stats-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.stats-list li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

/* Boutons */
.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 2rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-edit {
    background: white;
    color: var(--primary);
    border: 1px solid var(--primary);
}

.btn-return {
    background: var(--primary);
    color: white;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* États vides */
.empty-state {
    text-align: center;
    padding: 2rem;
    color: var(--text-secondary);
}

.empty-state i {
    font-size: 2rem;
    margin-bottom: 1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
    
    .info-columns {
        grid-template-columns: 1fr;
    }
    
    .header-content {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .header-actions {
        width: 100%;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .btn-action {
        width: 100%;
        justify-content: center;
    }
}
</style>