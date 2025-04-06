<div class="company-view">
    <div class="container">
        <!-- En-tête -->
        <div class="header-section">
            <div class="header-content">
                <h1 class="company-title"><?= htmlspecialchars($company['name']) ?></h1>
                <div class="header-actions">
                    <?php if (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['admin', 'pilote'])): ?>
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
                <!-- Statistiques -->
                <div class="info-card">
                    <div class="card-body">
                        <h2 class="section-title">Statistiques</h2>
                        <ul class="stats-list">
                            <li>
                                <i class="fas fa-star text-yellow"></i>
                                <span><?= number_format($company['rating'] ?? 0, 1) ?>/5 
                                    (<?= $company['rating_count'] ?? 0 ?> avis)</span>
                            </li>
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

                <!-- Notation -->
                <div class="info-card">
                    <div class="card-body">
                        <h2 class="section-title">Noter l'entreprise</h2>
                        <form action="/srx/companies/rate/<?= $company['id'] ?>" method="POST" class="rating-form">
                            <div class="rating-stars">
                                <?php for($i = 5; $i >= 1; $i--): ?>
                                    <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" 
                                        <?= ($user_rating && $user_rating['rating'] == $i) ? 'checked' : '' ?> required>
                                    <label for="star<?= $i ?>"><i class="fas fa-star"></i></label>
                                <?php endfor; ?>
                            </div>
                            <div class="form-group">
                                <label for="comment">Commentaire (optionnel)</label>
                                <textarea name="comment" id="comment" class="form-control" rows="3"><?= htmlspecialchars($user_rating['comment'] ?? '') ?></textarea>
                            </div>
                            <button type="submit" class="btn-submit">
                                <?= $user_rating ? 'Modifier ma note' : 'Envoyer' ?>
                            </button>
                        </form>
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
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.stats-list li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--text-primary);
}

.stats-list i {
    color: var(--primary);
    font-size: 1.2rem;
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

/* Ajout du style pour le système de notation */
.rating-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    padding: 1rem;
}

.rating-stars {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.rating-stars input {
    display: none;
}

.rating-stars label {
    cursor: pointer;
    font-size: 2rem;
    color: #e2e8f0;
    transition: all 0.2s ease;
}

.rating-stars label:hover,
.rating-stars label:hover ~ label,
.rating-stars input:checked ~ label {
    color: #fbbf24;
}

.rating-stars label:hover i,
.rating-stars label:hover ~ label i,
.rating-stars input:checked ~ label i {
    transform: scale(1.2);
}

.rating-stars i {
    transition: transform 0.2s ease;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-control {
    padding: 0.75rem;
    border: 1px solid var(--border);
    border-radius: 0.5rem;
    resize: vertical;
    font-size: 1rem;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
}

.btn-submit {
    background: var(--primary);
    color: white;
    border: none;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
    width: 100%;
    font-size: 1rem;
}

.btn-submit:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

.btn-submit:active {
    transform: translateY(0);
}

.rating-count {
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.stats-section {
    padding: 3rem 0;
    background: linear-gradient(135deg, #f8faff 0%, #f0f5ff 100%);
    border-radius: 20px;
    margin: 2rem 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    padding: 0 2rem;
}

.stat-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #3B82F6, #60A5FA);
}

.stat-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    background: linear-gradient(135deg, #3B82F6, #60A5FA);
}

.stat-title {
    font-size: 1.1rem;
    color: #4B5563;
    font-weight: 600;
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1F2937;
    margin-bottom: 1rem;
}

/* Barre de progression circulaire */
.progress-circle {
    position: relative;
    width: 120px;
    height: 120px;
    margin: 1rem auto;
}

.progress-circle-bg {
    fill: none;
    stroke: #E5E7EB;
    stroke-width: 8;
}

.progress-circle-value {
    fill: none;
    stroke: #3B82F6;
    stroke-width: 8;
    stroke-linecap: round;
    transform: rotate(-90deg);
    transform-origin: 50% 50%;
    transition: stroke-dasharray 1s ease;
}

.progress-circle text {
    font-size: 24px;
    font-weight: bold;
    fill: #1F2937;
}

/* Graphique en barres */
.bar-chart {
    height: 200px;
    display: flex;
    align-items: flex-end;
    gap: 1rem;
    padding: 1rem 0;
}

.bar {
    flex: 1;
    background: linear-gradient(180deg, #3B82F6, #60A5FA);
    border-radius: 6px 6px 0 0;
    position: relative;
    transition: height 1s ease;
    min-width: 30px;
}

.bar::before {
    content: attr(data-value);
    position: absolute;
    top: -25px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 0.875rem;
    font-weight: 600;
    color: #4B5563;
}

.bar-label {
    position: absolute;
    bottom: -25px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 0.875rem;
    color: #6B7280;
    white-space: nowrap;
}

/* Graphique en ligne */
.line-chart {
    height: 200px;
    position: relative;
    padding: 1rem 0;
    margin-top: 2rem;
}

.line-path {
    fill: none;
    stroke: #3B82F6;
    stroke-width: 3;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.point {
    fill: white;
    stroke: #3B82F6;
    stroke-width: 3;
    cursor: pointer;
    transition: transform 0.2s ease;
}

.point:hover {
    transform: scale(1.5);
}

/* Carte de tendance */
.trend-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #F3F4F6;
    border-radius: 12px;
    margin-top: 1rem;
}

.trend-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.trend-up {
    background: #DEF7EC;
    color: #059669;
}

.trend-down {
    background: #FEE2E2;
    color: #DC2626;
}

.trend-info {
    flex: 1;
}

.trend-value {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1F2937;
}

.trend-label {
    font-size: 0.875rem;
    color: #6B7280;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
}
</style><div class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <!-- Statistiques des stages -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="stat-title">Stages proposés</h3>
                </div>
                <div class="stat-value"><?= $stats['total_internships'] ?? 0 ?></div>
                <svg class="progress-circle" viewBox="0 0 100 100">
                    <circle class="progress-circle-bg" cx="50" cy="50" r="45"/>
                    <circle class="progress-circle-value" cx="50" cy="50" r="45" 
                            stroke-dasharray="<?= ($stats['active_internships'] ?? 0) / ($stats['total_internships'] ?? 1) * 283 ?> 283"/>
                    <text x="50" y="50" text-anchor="middle" dy=".3em"><?= $stats['active_internships'] ?? 0 ?></text>
                </svg>
                <div class="trend-card">
                    <div class="trend-icon <?= ($stats['internship_trend'] ?? 0) > 0 ? 'trend-up' : 'trend-down' ?>">
                        <i class="fas fa-<?= ($stats['internship_trend'] ?? 0) > 0 ? 'arrow-up' : 'arrow-down' ?>"></i>
                    </div>
                    <div class="trend-info">
                        <div class="trend-value"><?= abs($stats['internship_trend'] ?? 0) ?>%</div>
                        <div class="trend-label">vs mois précédent</div>
                    </div>
                </div>
            </div>

            <!-- Statistiques des candidatures -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="stat-title">Candidatures reçues</h3>
                </div>
                <div class="stat-value"><?= $stats['total_applications'] ?? 0 ?></div>
                <div class="bar-chart">
                    <?php
                    $months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'];
                    $values = $stats['monthly_applications'] ?? [30, 45, 60, 35, 50, 70];
                    $max = max($values);
                    foreach ($values as $i => $value):
                        $height = ($value / $max) * 100;
                    ?>
                    <div class="bar" style="height: <?= $height ?>%" data-value="<?= $value ?>">
                        <span class="bar-label"><?= $months[$i] ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Statistiques des évaluations -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="stat-title">Satisfaction globale</h3>
                </div>
                <div class="stat-value"><?= number_format($stats['average_rating'] ?? 0, 1) ?>/5</div>
                <div class="bar-chart">
                    <?php
                    for ($i = 5; $i >= 1; $i--):
                        $count = $stats['rating_distribution'][$i] ?? 0;
                        $total = array_sum($stats['rating_distribution'] ?? []);
                        $percentage = $total > 0 ? ($count / $total) * 100 : 0;
                    ?>
                    <div class="bar" style="height: <?= $percentage ?>%" data-value="<?= $count ?>">
                        <span class="bar-label"><?= $i ?>★</span>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</div>

