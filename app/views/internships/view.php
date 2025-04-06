<?php
if (isset($data)) {
    extract($data);
}

// Définition des valeurs par défaut pour éviter les erreurs
$default_internship = [
    'title' => 'Stage',
    'company_name' => 'Entreprise',
    'company_rating' => 0,
    'rating_count' => 0,
    'duration' => 0,
    'compensation' => 0,
    'location' => 'Non spécifié',
    'start_date' => date('Y-m-d'),
    'description' => 'Aucune description disponible',
    'skills_required' => '',
    'company_id' => 0,
    'active_internships' => 0,
    'total_applications' => 0,
    'company_description' => 'Aucune description disponible',
    'views_count' => 0,
    'applications_count' => 0,
    'saved_count' => 0
];

// Fusion avec les valeurs par défaut
$internship = array_merge($default_internship, isset($internship) ? $internship : []);
?>

<div class="internship-page">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-background"></div>
        <div class="hero-content container">
            <div class="hero-main">
                <div class="company-badge">
                    <?php
                    $initials = strtoupper(substr($internship['company_name'], 0, 2));
                    ?>
                    <div class="badge-avatar"><?= htmlspecialchars($initials) ?></div>
                    <div class="badge-info">
                <h1 class="internship-title"><?= htmlspecialchars($internship['title']) ?></h1>
                        <div class="company-info">
                            <span class="company-name">
                                <i class="fas fa-building"></i>
                                <?= htmlspecialchars($internship['company_name']) ?>
                            </span>
                            <div class="company-rating">
                                <div class="stars">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star <?= $i <= intval($internship['company_rating']) ? 'active' : '' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                                <span class="rating-count">(<?= intval($internship['rating_count']) ?>)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Hero Section Actions -->
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="hero-actions">
                        <?php if ($_SESSION['user']['role'] !== 'pilote'): ?>
                            <button type="button" class="btn-wishlist <?= $isInWishlist ? 'active' : '' ?>" 
                                    onclick="toggleWishlist(<?= $internship['id'] ?>)" 
                                    title="<?= $isInWishlist ? 'Retirer des favoris' : 'Ajouter aux favoris' ?>">
                                <i class="fas fa-star"></i>
                            </button>
                        <?php endif; ?>

                        <?php if ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'pilote'): ?>
                            <a href="/srx/internships/edit/<?= $internship['id'] ?>" class="btn-edit" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn-delete" onclick="confirmDelete(<?= $internship['id'] ?>)" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="key-metrics">
                <div class="metric">
                    <i class="fas fa-calendar-alt"></i>
                    <div class="metric-info">
                        <span class="metric-value"><?= intval($internship['duration']) ?> semaines</span>
                        <span class="metric-label">Durée</span>
                    </div>
                </div>
                <div class="metric">
                    <i class="fas fa-euro-sign"></i>
                    <div class="metric-info">
                        <span class="metric-value"><?= number_format(floatval($internship['compensation']), 2) ?>€</span>
                        <span class="metric-label">/ mois</span>
                    </div>
                </div>
                <div class="metric">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="metric-info">
                        <span class="metric-value"><?= htmlspecialchars($internship['location']) ?></span>
                        <span class="metric-label">Localisation</span>
                    </div>
                </div>
                <div class="metric">
                    <i class="fas fa-clock"></i>
                    <div class="metric-info">
                        <span class="metric-value"><?= date('d M Y', strtotime($internship['start_date'])) ?></span>
                        <span class="metric-label">Début</span>
                    </div>
                </div>
                </div>
            </div>
        </div>

    <!-- Main Content -->
    <div class="main-content container">
        <div class="content-grid">
            <!-- Left Column -->
            <div class="content-main">
                <!-- Description Section -->
                <div class="content-section description-section">
                    <button class="section-toggle" onclick="toggleSection('description-content')">
                        <h2 class="section-title">
                            <i class="fas fa-align-left"></i>
                            Description du stage
                        </h2>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </button>
                    <div class="description-content section-content" id="description-content" style="display: none;">
                        <?= nl2br(htmlspecialchars($internship['description'])) ?>
                    </div>
                </div>

                <!-- Skills Section -->
                <div class="content-section skills-section">
                    <button class="section-toggle" onclick="toggleSection('skills-content')">
                        <h2 class="section-title">
                            <i class="fas fa-code"></i>
                            Compétences requises
                        </h2>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </button>
                    <div class="skills-grid section-content" id="skills-content" style="display: none;">
                        <?php 
                        $skills = !empty($internship['skills_required']) ? explode(',', $internship['skills_required']) : [];
                        if (!empty($skills)):
                            foreach ($skills as $skill): 
                                $skill = trim($skill);
                                if (!empty($skill)):
                        ?>
                            <div class="skill-card">
                                <i class="fas fa-check-circle"></i>
                                <span><?= htmlspecialchars($skill) ?></span>
                            </div>
                        <?php 
                                endif;
                            endforeach;
                        else:
                        ?>
                            <div class="empty-skills">
                                <p>Aucune compétence spécifiée</p>
                            </div>
                        <?php endif; ?>
                        </div>

                    <?php if (isset($_SESSION['user'])): ?>
                        <div class="section-footer">
                            <div class="divider"></div>
                            <?php if ($_SESSION['user']['role'] !== 'pilote'): ?>
                                <?php if (isset($is_in_wishlist) && $is_in_wishlist): ?>
                                    <form method="POST" action="/srx/internships/toggleWishlist/<?= $internship['id'] ?>" class="footer-form">
                                        <button type="submit" class="btn-footer btn-footer-remove">
                                            <i class="fas fa-heart-broken"></i>
                                            <span>Retirer de ma liste de souhaits</span>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <form method="POST" action="/srx/internships/toggleWishlist/<?= $internship['id'] ?>" class="footer-form">
                                        <button type="submit" class="btn-footer btn-footer-add">
                                            <i class="fas fa-heart"></i>
                                            <span>Ajouter à ma liste de souhaits</span>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                            </div>

                <!-- Apply Section -->
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] !== 'pilote'): ?>
                <div class="apply-section">
                    <div class="section-header">
                        <h2>Postuler</h2>
                        <p>Envoyez votre candidature pour ce stage</p>
                    </div>
                    
                    <form action="/srx/internships/apply/<?= $internship['id'] ?>" method="POST" enctype="multipart/form-data" class="apply-form">
                        <div class="form-group file-upload-container">
                            <label for="cv">CV (PDF uniquement)</label>
                            <div class="file-upload-box" id="dropZone">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Glissez votre CV ici ou</p>
                                <label for="cv" class="file-label">Parcourir</label>
                                <input type="file" id="cv" name="cv" accept=".pdf" required class="file-input">
                                <p class="selected-file" id="selectedFile">Aucun fichier sélectionné</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="motivation">Lettre de motivation</label>
                            <textarea id="motivation" name="motivation" rows="6" required placeholder="Écrivez votre lettre de motivation..."></textarea>
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane"></i>
                            Envoyer ma candidature
                        </button>
                    </form>
                </div>
                <?php endif; ?>

                <!-- Student Actions for Mobile -->
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] !== 'pilote'): ?>
                    <div class="mobile-actions">
                        <!-- Wishlist Section Mobile -->
                        <div class="action-card wishlist-section" id="wishlist-section-mobile">
                            <div class="card-header">
                                <h3 class="section-title">
                                    <i class="fas fa-heart"></i>
                                    Liste de souhaits
                                </h3>
                            </div>
                            <div class="card-body">
                                <?php if (isset($is_in_wishlist) && $is_in_wishlist): ?>
                                    <div class="wishlist-status">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Ce stage est dans votre liste de souhaits</span>
                                    </div>
                                    <form method="POST" action="/srx/internships/toggleWishlist/<?= $internship['id'] ?>">
                                        <button type="submit" class="btn-action btn-wishlist btn-remove">
                                            <i class="fas fa-heart-broken"></i>
                                            Retirer de ma liste
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <div class="wishlist-status">
                                        <i class="far fa-heart"></i>
                                        <span>Ajoutez ce stage à votre liste pour le retrouver facilement</span>
                                    </div>
                                    <form method="POST" action="/srx/internships/toggleWishlist/<?= $internship['id'] ?>">
                                        <button type="submit" class="btn-action btn-wishlist btn-add">
                                            <i class="fas fa-heart"></i>
                                            Ajouter à ma liste
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right Column -->
            <div class="content-side">
                <!-- Company Card -->
                <div class="company-card">
                    <div class="company-card-header">
                        <div class="company-avatar">
                            <?= htmlspecialchars($initials) ?>
                </div>
                        <div class="company-details">
                            <h3><?= htmlspecialchars($internship['company_name']) ?></h3>
                            <div class="company-stats">
                                <span><i class="fas fa-briefcase"></i> <?= intval($internship['active_internships']) ?> stages</span>
                                <span><i class="fas fa-users"></i> <?= intval($internship['total_applications']) ?> candidats</span>
            </div>
                        </div>
                    </div>
                    <div class="company-card-body">
                        <p class="company-description">
                            <?= nl2br(htmlspecialchars($internship['company_description'])) ?>
                        </p>
                        <a href="/srx/companies/view/<?= intval($internship['company_id']) ?>" class="btn btn-outline btn-full">
                            <i class="fas fa-building"></i>
                            Voir le profil complet
                        </a>
                    </div>
                        </div>

                <!-- Statistics Card -->
                <div class="stats-card">
                    <h2 class="section-title">
                        <i class="fas fa-chart-line"></i>
                        Statistiques
                    </h2>
                    <div class="stats-grid">
                        <div class="stat-item views">
                            <div class="stat-header">
                                <i class="fas fa-eye"></i>
                                <div class="stat-info">
                                    <div class="stat-value" data-value="<?= intval($internship['views_count']) ?>">0</div>
                                    <div class="stat-label">Vues</div>
                        </div>
                    </div>
                            <div class="stat-progress">
                                <div class="progress-bar" style="width: <?= min((intval($internship['views_count']) / 1000) * 100, 100) ?>%"></div>
                </div>
                    </div>
                        <div class="stat-item applications">
                            <div class="stat-header">
                                <i class="fas fa-paper-plane"></i>
                                <div class="stat-info">
                                    <div class="stat-value" data-value="<?= intval($internship['applications_count']) ?>">0</div>
                                    <div class="stat-label">Candidatures</div>
                </div>
            </div>
                            <div class="stat-progress">
                                <div class="progress-bar" style="width: <?= min((intval($internship['applications_count']) / 50) * 100, 100) ?>%"></div>
        </div>
    </div>
                        <div class="stat-item saves">
                            <div class="stat-header">
                                <i class="fas fa-heart"></i>
                                <div class="stat-info">
                                    <div class="stat-value" data-value="<?= intval($internship['saved_count']) ?>">0</div>
                                    <div class="stat-label">Sauvegardés</div>
</div>
                            </div>
                            <div class="stat-progress">
                                <div class="progress-bar" style="width: <?= min((intval($internship['saved_count']) / 100) * 100, 100) ?>%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="stats-details">
                        <div class="detail-row">
                            <span>Taux de conversion</span>
                            <span class="highlight">
                                <?php
                                $views = intval($internship['views_count']);
                                $applications = intval($internship['applications_count']);
                                echo $views > 0 ? round(($applications / $views) * 100, 1) : 0;
                                ?>%
                            </span>
                        </div>
                        <div class="detail-row">
                            <span>Taux d'engagement</span>
                            <span class="highlight">
                                <?php
                                $saves = intval($internship['saved_count']);
                                echo $views > 0 ? round(($saves / $views) * 100, 1) : 0;
                                ?>%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
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
    
    /* Nouveaux gradients */
    --gradient-shine: linear-gradient(45deg, 
        rgba(255,255,255,0) 0%, 
        rgba(255,255,255,0.1) 50%, 
        rgba(255,255,255,0) 100%
    );
    --gradient-glow: radial-gradient(
        circle at center,
        rgba(79, 70, 229, 0.1) 0%,
        rgba(79, 70, 229, 0) 70%
    );
    
    /* Nouvelles animations */
    --animation-speed-fast: 0.3s;
    --animation-speed-normal: 0.5s;
    --animation-speed-slow: 0.8s;
}

/* Reset et styles de base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    line-height: 1.5;
    color: var(--gray-700);
    background-color: var(--gray-50);
}

.container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 var(--spacing-4);
}

/* Hero Section */
.hero-section {
    position: relative;
    min-height: 400px;
    background: var(--gray-900);
    color: white;
    overflow: hidden;
    width: 100%;
    margin: 0;
    padding: 0;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    padding: var(--spacing-8) var(--spacing-4);
}

.hero-main {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: var(--spacing-6);
    margin-bottom: var(--spacing-8);
    flex-wrap: wrap;
}

.company-badge {
    flex: 1;
    min-width: 280px;
}

.hero-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.key-metrics {
    width: 100%;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--spacing-4);
    padding: var(--spacing-6);
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(8px);
    border-radius: var(--radius-lg);
    margin: 0;
}

/* Main Content */
.main-content {
    padding: var(--spacing-8) 0;
    min-height: calc(100vh - 400px);
    position: relative;
    z-index: 1;
    background: var(--gray-50);
}

    .content-grid {
    display: grid;
        grid-template-columns: 2fr 1fr;
    gap: var(--spacing-8);
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 var(--spacing-4);
}

/* Content Sections */
.content-section {
    background: white;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
    overflow: hidden;
    margin-bottom: var(--spacing-6);
    transition: var(--transition);
}

.content-section:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
}

.section-title {
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
    padding: var(--spacing-6);
    border-bottom: 1px solid var(--gray-200);
    font-size: 1.25rem;
    color: var(--gray-900);
}

.section-title i {
    color: var(--primary);
}

/* Description Section */
.description-content {
    padding: var(--spacing-6);
    color: var(--gray-600);
    line-height: 1.8;
}

/* Skills Section */
.skills-grid {
    display: flex;
    flex-wrap: wrap;
    gap: var(--spacing-3);
    padding: var(--spacing-6);
}

.skill-card {
    display: flex;
    align-items: center;
    gap: var(--spacing-2);
    padding: var(--spacing-3) var(--spacing-4);
    background: var(--gray-100);
    border-radius: var(--radius-full);
    color: var(--gray-700);
    font-size: 0.875rem;
    transition: var(--transition);
}

.skill-card:hover {
    background: var(--primary);
    color: white;
    transform: translateY(-2px);
}

.skill-card i {
    color: var(--success);
}

.skill-card:hover i {
    color: white;
}

/* Company Card */
.company-card {
    background: white;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
    overflow: hidden;
    margin-bottom: var(--spacing-6);
}

.company-card-header {
    padding: var(--spacing-6);
    background: var(--gradient-primary);
    color: white;
    display: flex;
    align-items: center;
    gap: var(--spacing-4);
}

.company-avatar {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: var(--radius);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 600;
}

.company-details h3 {
    font-size: 1.25rem;
    margin-bottom: var(--spacing-2);
}

.company-stats {
    display: flex;
    gap: var(--spacing-4);
    font-size: 0.875rem;
    opacity: 0.9;
}

.company-card-body {
    padding: var(--spacing-6);
}

.company-description {
    color: var(--gray-600);
    margin-bottom: var(--spacing-6);
    line-height: 1.7;
}

/* Statistics Card */
.stats-card {
    background: white;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
    overflow: hidden;
}

.stats-grid {
    padding: var(--spacing-6);
    display: grid;
    gap: var(--spacing-4);
}

.stat-item {
    background: var(--gray-50);
    border-radius: var(--radius);
    padding: var(--spacing-4);
    transition: var(--transition);
}

.stat-item:hover {
    transform: translateY(-2px);
}

.stat-header {
    display: flex;
    align-items: center;
    gap: var(--spacing-4);
    margin-bottom: var(--spacing-4);
}

.stat-header i {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--primary);
    color: white;
    border-radius: var(--radius);
    font-size: 1.25rem;
}

.views i { background: var(--primary); }
.applications i { background: var(--success); }
.saves i { background: var(--warning); }

.stat-info {
    flex: 1;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--gray-900);
    line-height: 1;
}

.stat-label {
    font-size: 0.875rem;
    color: var(--gray-500);
    margin-top: var(--spacing-1);
}

.stat-progress {
    height: 4px;
    background: var(--gray-200);
    border-radius: var(--radius-full);
    overflow: hidden;
}

.stat-progress .progress-bar {
    height: 100%;
    background: var(--primary);
    border-radius: var(--radius-full);
    transition: width 1s ease-in-out;
}

.views .progress-bar { background: var(--primary); }
.applications .progress-bar { background: var(--success); }
.saves .progress-bar { background: var(--warning); }

.stats-details {
    padding: var(--spacing-6);
    border-top: 1px solid var(--gray-200);
}

.detail-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-3) 0;
    color: var(--gray-600);
    font-size: 0.875rem;
}

.detail-row:not(:last-child) {
    border-bottom: 1px solid var(--gray-100);
}

.highlight {
    color: var(--primary);
    font-weight: 600;
}

/* Boutons */
.btn {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-2);
    padding: var(--spacing-3) var(--spacing-6);
    border-radius: var(--radius);
    font-size: 0.875rem;
    font-weight: 500;
    transition: var(--transition);
    border: none;
    cursor: pointer;
    text-decoration: none;
}

.btn i {
    font-size: 1rem;
}

.btn-apply {
    background: var(--gradient-primary);
    color: white;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}

.btn-apply:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4);
}

.btn-save {
    background: white;
    color: var(--gray-700);
    border: 1px solid var(--gray-300);
}

.btn-save:hover {
    border-color: var(--primary);
    color: var(--primary);
}

.btn-edit {
    background: var(--gray-100);
    color: var(--gray-700);
}

.btn-edit:hover {
    background: var(--gray-200);
}

.btn-delete {
    background: var(--gray-100);
    color: var(--danger);
}

.btn-delete:hover {
    background: var(--danger);
    color: white;
}

.btn-outline {
    background: transparent;
    border: 1px solid var(--gray-300);
    color: var(--gray-700);
}

.btn-outline:hover {
    border-color: var(--primary);
    color: var(--primary);
}

.btn-full {
    width: 100%;
    justify-content: center;
}

/* Animations */
@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(79, 70, 229, 0); }
    100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); }
}

.pulse-animation {
    animation: pulse 2s infinite;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.content-section {
    animation: slideIn 0.6s ease-out;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
    
    .content-side {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: var(--spacing-6);
    }
}

@media (max-width: 768px) {
    .hero-section {
        min-height: auto;
        padding: var(--spacing-4) 0;
    }

    .hero-content {
        padding: var(--spacing-4);
    }

    .hero-main {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: var(--spacing-4);
    }

    .company-badge {
        min-width: 100%;
    }

    .hero-actions {
        flex-wrap: wrap;
        justify-content: center;
    }

    .key-metrics {
        grid-template-columns: 1fr;
        padding: var(--spacing-4);
    }

    .content-grid {
        grid-template-columns: 1fr;
        gap: var(--spacing-4);
    }

    .section-footer {
        padding: var(--spacing-4);
        margin: 0;
        border-radius: 0;
    }

    .btn-footer {
        padding: var(--spacing-3);
        font-size: 0.9rem;
    }
}

@media (max-width: 640px) {
    .internship-title {
        font-size: 2rem;
    }
    
    .key-metrics {
        grid-template-columns: 1fr;
    }
    
    .company-badge {
        flex-direction: column;
        align-items: flex-start;
    }
}

/* Ajout d'un style pour les compétences vides */
.empty-skills {
    padding: var(--spacing-6);
    text-align: center;
    color: var(--gray-500);
    font-style: italic;
}

/* Effet de fond animé pour le hero */
.hero-section::before {
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

.hero-section::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.1;
    z-index: 0;
    animation: patternMove 20s linear infinite;
}

/* Animation du badge entreprise */
.badge-avatar {
    position: relative;
    overflow: hidden;
    transform: rotate(-3deg);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.badge-avatar::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: var(--gradient-shine);
    transform: rotate(45deg);
    animation: shine 3s infinite;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.badge-avatar:hover {
    transform: rotate(0) scale(1.1);
    box-shadow: 
        0 20px 25px -5px rgba(79, 70, 229, 0.25),
        0 8px 10px -6px rgba(79, 70, 229, 0.1);
}

.badge-avatar:hover::before {
    opacity: 1;
}

/* Amélioration des boutons */
.btn {
    position: relative;
    overflow: hidden;
    transform: translateY(0);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--gradient-shine);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.btn:hover {
    transform: translateY(-3px);
}

.btn:hover::before {
    transform: translateX(100%);
}

.btn-apply {
    animation: pulse 2s infinite;
}

.btn-apply:hover {
    animation: none;
    transform: translateY(-3px) scale(1.05);
    box-shadow: 
        0 20px 25px -5px rgba(79, 70, 229, 0.3),
        0 8px 10px -6px rgba(79, 70, 229, 0.2);
}

/* Amélioration des cartes */
.content-section, .company-card, .stats-card {
    position: relative;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.content-section::before,
.company-card::before,
.stats-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: var(--gradient-glow);
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.content-section:hover::before,
.company-card:hover::before,
.stats-card:hover::before {
    opacity: 1;
}

/* Animation des compétences */
.skill-card {
    position: relative;
    overflow: hidden;
    transform: translateY(0);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.skill-card::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: var(--gradient-primary);
    border-radius: inherit;
    opacity: 0;
    z-index: -1;
    transition: opacity 0.3s ease;
}

.skill-card:hover {
    transform: translateY(-3px) scale(1.05);
    color: white;
}

.skill-card:hover::before {
    opacity: 1;
}

/* Animation des statistiques */
.stat-item {
    position: relative;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.stat-item::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--gradient-shine);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
    box-shadow: 
        0 10px 15px -3px rgba(0, 0, 0, 0.1),
        0 4px 6px -4px rgba(0, 0, 0, 0.05);
}

.stat-item:hover::after {
    transform: translateX(100%);
}

/* Nouvelles animations */
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

@keyframes patternMove {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 100px 100px;
    }
}

@keyframes shine {
    0% {
        transform: rotate(45deg) translateX(-100%);
    }
    10%, 100% {
        transform: rotate(45deg) translateX(100%);
    }
}

@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
    100% {
        transform: translateY(0px);
    }
}

/* Animation d'entrée des sections */
.content-section {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.8s ease forwards;
}

.content-section:nth-child(1) { animation-delay: 0.2s; }
.content-section:nth-child(2) { animation-delay: 0.4s; }

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

/* Amélioration des métriques */
.metric {
    position: relative;
    overflow: hidden;
}

.metric i {
    animation: float 3s ease-in-out infinite;
}

.metric:hover .metric-value {
    transform: scale(1.1);
    color: var(--primary-light);
}

.metric-value {
    transition: all 0.3s ease;
}

/* Effet de survol sur les étoiles */
.stars i {
    transition: all 0.3s ease;
    transform: scale(1);
}

.stars:hover i {
    transform: scale(0.9);
}

.stars i:hover {
    transform: scale(1.2) rotate(15deg);
    color: var(--warning);
}

/* Animation du bouton de suppression */
.btn-delete {
    transition: all 0.3s ease;
}

.btn-delete:hover {
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

/* Effet de glassmorphisme amélioré */
.key-metrics {
    backdrop-filter: blur(12px);
    background: linear-gradient(
        135deg,
        rgba(255, 255, 255, 0.1) 0%,
        rgba(255, 255, 255, 0.05) 100%
    );
    border: 1px solid rgba(255, 255, 255, 0.18);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
}

/* Mobile Actions */
.mobile-actions {
    display: none;
}

@media (max-width: 1024px) {
    .mobile-actions {
    display: block;
    }
    
    .content-side .action-card {
        display: none;
    }
}

/* Action Cards Styles */
.action-card {
    background: white;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
    overflow: hidden;
    transition: var(--transition);
    margin-bottom: var(--spacing-6);
}

.action-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
}

.action-card .card-header {
    padding: var(--spacing-6);
    border-bottom: 1px solid var(--gray-200);
}

.action-card .card-body {
    padding: var(--spacing-6);
}

/* Wishlist Section */
.wishlist-section .card-header {
    background: linear-gradient(135deg, var(--warning) 0%, #f97316 100%);
}

.wishlist-section .section-title {
    color: white;
    margin: 0;
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
}

.wishlist-status {
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
    margin-bottom: var(--spacing-6);
    padding: var(--spacing-4);
    border-radius: var(--radius);
    background: var(--gray-50);
}

.wishlist-status i {
    font-size: 1.5rem;
    color: var(--warning);
}

/* Application Section */
.apply-section .card-header {
    background: var(--gradient-primary);
}

.apply-section .section-title {
    color: white;
    margin: 0;
}

.file-upload {
    position: relative;
    border: 2px dashed var(--gray-300);
    border-radius: var(--radius);
    padding: var(--spacing-8);
    text-align: center;
    transition: var(--transition);
    cursor: pointer;
    background: var(--gray-50);
    margin-bottom: var(--spacing-4);
}

.file-upload:hover {
    border-color: var(--primary);
    background: white;
}

/* Button Styles */
.btn-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: var(--spacing-2);
    width: 100%;
    padding: var(--spacing-4);
    border-radius: var(--radius);
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-wishlist.btn-add {
    background: white;
    color: var(--warning);
    border: 1px solid var(--warning);
}

.btn-wishlist.btn-add:hover {
    background: var(--warning);
    color: white;
    transform: translateY(-2px);
}

.btn-wishlist.btn-remove {
    background: white;
    color: var(--danger);
    border: 1px solid var(--danger);
}

.btn-wishlist.btn-remove:hover {
    background: var(--danger);
    color: white;
    transform: translateY(-2px);
}

.btn-apply-submit {
    background: var(--gradient-primary);
    color: white;
    border: none;
}

.btn-apply-submit:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

/* Wishlist Button Section */
.wishlist-button-section {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border);
}

.btn-wishlist {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    width: 100%;
    padding: 1rem 2rem;
    border-radius: 0.75rem;
    font-size: 1rem;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
    border: 1px solid transparent;
    background: white;
}

.btn-wishlist.btn-add {
    color: var(--primary);
    border-color: var(--primary);
}

.btn-wishlist.btn-add:hover {
    background: var(--primary);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(37, 99, 235, 0.1);
}

.btn-wishlist.btn-remove {
    color: var(--danger);
    border-color: var(--danger);
}

.btn-wishlist.btn-remove:hover {
    background: var(--danger);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(239, 68, 68, 0.1);
}

.btn-wishlist i {
    font-size: 1.25rem;
    transition: transform 0.3s ease;
}

.btn-wishlist:hover i {
    transform: scale(1.2);
}

@media (max-width: 768px) {
    .wishlist-button-section {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
    }

    .btn-wishlist {
        padding: 0.75rem 1.5rem;
    }
}

/* Card Styles */
.info-card {
    background: white;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
    margin-bottom: var(--spacing-6);
    overflow: hidden;
    transition: var(--transition);
}

.info-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
}

.card-body {
    padding: var(--spacing-6);
}

/* Wishlist Content */
.wishlist-content {
    display: flex;
        flex-direction: column;
    gap: var(--spacing-4);
}

.status-message {
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
    padding: var(--spacing-4);
    background: var(--gray-50);
    border-radius: var(--radius);
}

.status-message i {
    font-size: 1.25rem;
}

.text-success {
    color: var(--success);
}

.text-primary {
    color: var(--primary);
}

/* Button Styles */
.btn-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: var(--spacing-2);
        width: 100%;
    padding: var(--spacing-4);
    border-radius: var(--radius);
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-add {
    background: white;
    color: var(--primary);
    border: 1px solid var(--primary);
}

.btn-add:hover {
    background: var(--primary);
    color: white;
    transform: translateY(-2px);
}

.btn-remove {
    background: white;
    color: var(--danger);
    border: 1px solid var(--danger);
}

.btn-remove:hover {
    background: var(--danger);
    color: white;
    transform: translateY(-2px);
}

/* Application Form */
.application-form {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-6);
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-2);
}

.form-group label {
    font-weight: 500;
    color: var(--gray-700);
}

.file-upload {
    position: relative;
    border: 2px dashed var(--gray-300);
    border-radius: var(--radius);
    padding: var(--spacing-8);
    text-align: center;
    background: var(--gray-50);
    cursor: pointer;
    transition: var(--transition);
}

.file-upload:hover {
    border-color: var(--primary);
    background: white;
}

.upload-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--spacing-3);
    color: var(--gray-600);
}

.upload-placeholder i {
    font-size: 2rem;
    color: var(--primary);
}

.form-control {
    padding: var(--spacing-3) var(--spacing-4);
    border: 1px solid var(--gray-300);
    border-radius: var(--radius);
    transition: var(--transition);
}

.form-control:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

.btn-submit {
    background: var(--gradient-primary);
    color: white;
    border: none;
    padding: var(--spacing-4);
    border-radius: var(--radius);
    font-weight: 500;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
        justify-content: center;
    gap: var(--spacing-2);
    width: 100%;
    transition: all 0.3s ease;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

@media (max-width: 768px) {
    .info-card {
        margin-bottom: var(--spacing-4);
    }

    .card-body {
        padding: var(--spacing-4);
    }

    .file-upload {
        padding: var(--spacing-4);
    }

    .btn-action, .btn-submit {
        padding: var(--spacing-3);
    }
}

/* Ajout des nouveaux styles pour les sections toggle */
.section-toggle {
    width: 100%;
    background: none;
    border: none;
    padding: 0;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-6);
    border-bottom: 1px solid var(--gray-200);
    transition: all 0.3s ease;
}

.section-toggle:hover {
    background-color: var(--gray-50);
}

.section-toggle .section-title {
    margin: 0;
    padding: 0;
    border: none;
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
}

.toggle-icon {
    color: var(--gray-400);
    transition: transform 0.3s ease;
    font-size: 1rem;
}

.section-toggle[aria-expanded="true"] .toggle-icon {
    transform: rotate(180deg);
}

.section-content {
    max-height: 0;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    opacity: 0;
}

.section-content.active {
    max-height: 2000px;
    opacity: 1;
    padding: var(--spacing-6);
}

/* Animation pour l'icône et le contenu */
@keyframes rotateIcon {
    from { transform: rotate(0deg); }
    to { transform: rotate(180deg); }
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Actions Section Styles */
.actions-section {
    margin-top: var(--spacing-6);
    padding: var(--spacing-6);
    background: white;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
}

.actions-container {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-4);
}

.action-button-container {
    width: 100%;
}

.action-form {
    width: 100%;
}

.btn-action-large {
    width: 100%;
    padding: var(--spacing-4) var(--spacing-6);
    border-radius: var(--radius);
    font-size: 1rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: var(--spacing-3);
    transition: all 0.3s ease;
    cursor: pointer;
    border: 2px solid transparent;
}

.btn-action-large i {
    font-size: 1.25rem;
    transition: transform 0.3s ease;
}

.btn-action-large:hover i {
    transform: scale(1.2);
}

.btn-action-large.btn-add {
    background: white;
    color: var(--primary);
    border-color: var(--primary);
}

.btn-action-large.btn-add:hover {
    background: var(--primary);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
}

.btn-action-large.btn-remove {
    background: white;
    color: var(--danger);
    border-color: var(--danger);
}

.btn-action-large.btn-remove:hover {
    background: var(--danger);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
}

.btn-action-large.btn-apply {
    background: var(--gradient-primary);
    color: white;
    border: none;
}

.btn-action-large.btn-apply:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}

@media (max-width: 768px) {
    .actions-section {
        margin-top: var(--spacing-4);
        padding: var(--spacing-4);
    }

    .btn-action-large {
        padding: var(--spacing-3) var(--spacing-4);
        font-size: 0.875rem;
    }
}

/* Styles pour le footer de section */
.section-footer {
    padding: var(--spacing-6);
    margin-top: var(--spacing-4);
    border-top: 1px solid var(--gray-200);
    background: white;
    border-radius: 0 0 var(--radius-lg) var(--radius-lg);
}

.divider {
    height: 1px;
    background: var(--gray-200);
    margin-bottom: var(--spacing-6);
}

.btn-footer {
    width: 100%;
    padding: var(--spacing-4);
    border-radius: var(--radius-lg);
    font-size: 1rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: var(--spacing-3);
    transition: all 0.3s ease;
    cursor: pointer;
    border: 2px solid transparent;
}

.btn-footer i {
    font-size: 1.25rem;
    transition: transform 0.3s ease;
}

.btn-footer:hover i {
    transform: scale(1.2);
}

.btn-footer-add {
    color: var(--primary);
    border-color: var(--primary);
}

.btn-footer-add:hover {
    background: var(--primary);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
}

.btn-footer-remove {
    color: var(--danger);
    border-color: var(--danger);
}

.btn-footer-remove:hover {
    background: var(--danger);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
}

@media (max-width: 768px) {
    .section-footer {
        padding: var(--spacing-4);
    }

    .btn-footer {
        padding: var(--spacing-3);
        font-size: 0.9rem;
    }
}

/* Apply Section Styles */
.apply-section {
    margin-top: var(--spacing-6);
    background: white !important;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    transition: all 0.3s ease;
}

.apply-section:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.apply-section .section-header {
    padding: var(--spacing-6);
    background: var(--primary);
    color: white;
    position: relative;
}

.apply-section .section-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 0%, rgba(255, 255, 255, 0.1) 100%);
    z-index: 1;
}

.apply-section .section-header h2 {
    color: white;
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
    position: relative;
    z-index: 2;
}

.apply-section .section-header p {
    color: rgba(255, 255, 255, 0.8);
    margin: var(--spacing-2) 0 0;
    font-size: 0.95rem;
    position: relative;
    z-index: 2;
}

.apply-form {
    background: white;
    padding: var(--spacing-6);
}

/* File Upload Styles */
.file-upload-container {
    position: relative;
}

.file-upload-box {
    border: 2px dashed var(--gray-300);
    border-radius: var(--radius-lg);
    padding: var(--spacing-8) var(--spacing-4);
    text-align: center;
    background: var(--gray-50);
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.file-upload-box:hover {
    border-color: var(--primary);
    background: white;
    transform: translateY(-2px);
}

.file-upload-box i {
    font-size: 2.5rem;
    color: var(--primary);
    margin-bottom: var(--spacing-4);
    transition: all 0.3s ease;
}

.file-upload-box:hover i {
    transform: scale(1.1) translateY(-5px);
}

.file-upload-box p {
    color: var(--gray-600);
    margin-bottom: var(--spacing-3);
    font-size: 0.95rem;
}

.file-label {
    display: inline-block;
    padding: var(--spacing-2) var(--spacing-4);
    background: var(--primary);
    color: white;
    border-radius: var(--radius);
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.file-label:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
}

.selected-file {
    margin-top: var(--spacing-3);
    padding: var(--spacing-2) var(--spacing-4);
    background: var(--gray-100);
    border-radius: var(--radius);
    font-size: 0.9rem;
    color: var(--gray-700);
    display: inline-block;
}

/* Motivation Letter Styles */
.form-group {
    position: relative;
}

.form-group label {
    display: block;
    margin-bottom: var(--spacing-2);
    color: var(--gray-700);
    font-weight: 600;
    font-size: 0.95rem;
}

textarea#motivation {
    width: 100%;
    min-height: 200px;
    padding: var(--spacing-4);
    border: 2px solid var(--gray-200);
    border-radius: var(--radius-lg);
    background: white;
    color: var(--gray-800);
    font-size: 0.95rem;
    line-height: 1.6;
    transition: all 0.3s ease;
    resize: vertical;
}

textarea#motivation:hover {
    border-color: var(--primary-light);
}

textarea#motivation:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
}

textarea#motivation::placeholder {
    color: var(--gray-400);
}

/* Submit Button Styles */
.btn-submit {
    margin-top: var(--spacing-4);
    padding: var(--spacing-4);
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
    border: none;
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--spacing-3);
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-submit::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.2),
        transparent
    );
    transition: 0.5s;
}

.btn-submit:hover::before {
    left: 100%;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}

.btn-submit i {
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

.btn-submit:hover i {
    transform: translateX(4px);
}

/* Responsive Styles */
@media (max-width: 768px) {
    .apply-section {
        margin: var(--spacing-4) -var(--spacing-4);
        border-radius: 0;
    }

    .apply-form {
        padding: var(--spacing-4);
    }

    .file-upload-box {
        padding: var(--spacing-6) var(--spacing-3);
    }

    .btn-submit {
        position: sticky;
        bottom: 0;
        margin: var(--spacing-4) -var(--spacing-4) -var(--spacing-4);
        border-radius: 0;
        padding: calc(var(--spacing-4) + env(safe-area-inset-bottom));
        z-index: 10;
    }
}

/* Dark Mode Support */
@media (prefers-color-scheme: dark) {
    .apply-section {
        background: white !important;
    }

    .apply-form {
        background: white !important;
    }

    textarea#motivation {
        background: white !important;
        color: var(--gray-800) !important;
    }

    .file-upload-box {
        background: var(--gray-50) !important;
    }
}

/* Animation d'entrée */
@keyframes slideUpIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.apply-section {
    animation: slideUpIn 0.5s ease-out;
}

/* Effet de focus amélioré */
.form-group:focus-within label {
    color: var(--primary);
}

/* État de chargement */
.btn-submit.loading {
    background: var(--gray-400);
    pointer-events: none;
}

.btn-submit.loading i {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Améliorations Responsive Supplémentaires */
@media (max-width: 1024px) {
    .hero-section {
        min-height: 300px;
    }

    .key-metrics {
        background: rgba(255, 255, 255, 0.15);
        margin: 0 var(--spacing-4);
    }

    .company-card-header {
        flex-direction: column;
        text-align: center;
        padding: var(--spacing-4);
    }

    .company-stats {
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .hero-background {
        opacity: 0.15;
    }

    .badge-avatar {
        transform: rotate(0);
        margin: 0 auto;
    }

    .company-info {
        justify-content: center;
    }

    .stars {
        justify-content: center;
    }

    .apply-section {
        border-radius: var(--radius) var(--radius) 0 0;
    }

    .file-upload-container {
        margin: 0;
    }

    .file-upload-box {
        border-width: 1px;
    }

    .motivation-input {
        border-width: 1px;
        font-size: 16px; /* Évite le zoom sur iOS */
    }

    .submit-button {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        margin: 0;
        border-radius: 0;
        padding: var(--spacing-4);
        z-index: 100;
    }

    .content-section {
        margin-bottom: var(--spacing-4);
        border-radius: var(--radius);
    }

    .section-toggle {
        padding: var(--spacing-4);
    }

    .skills-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: var(--spacing-2);
    }

    .skill-card {
        margin: 0;
        text-align: center;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .hero-section {
        min-height: auto;
    }

    .key-metrics {
        padding: var(--spacing-3);
        grid-template-columns: 1fr;
    }

    .metric {
        background: rgba(255, 255, 255, 0.1);
        border-radius: var(--radius);
        padding: var(--spacing-3);
    }

    .company-card, .stats-card {
        border-radius: var(--radius);
        margin: 0 var(--spacing-2) var(--spacing-4) var(--spacing-2);
    }

    .stats-grid {
        padding: var(--spacing-3);
    }

    .stat-item {
        padding: var(--spacing-3);
    }

    .detail-row {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-1);
    }

    .highlight {
        font-size: 1.1rem;
    }

    .file-upload-box {
        padding: var(--spacing-4) var(--spacing-2);
    }

    .upload-text {
        font-size: 0.85rem;
    }
}

/* Optimisations pour les appareils avec notch */
@supports (padding: max(0px)) {
    .submit-button {
        padding-bottom: max(var(--spacing-4), env(safe-area-inset-bottom));
    }

    .container {
        padding-left: max(var(--spacing-4), env(safe-area-inset-left));
        padding-right: max(var(--spacing-4), env(safe-area-inset-right));
    }
}

/* Améliorations pour les grands écrans tactiles */
@media (min-width: 1024px) and (pointer: coarse) {
    .btn, .skill-card, .stat-item {
        min-height: 44px; /* Taille minimum pour les cibles tactiles */
    }

    .section-toggle {
        padding: var(--spacing-6) var(--spacing-4);
    }

    .file-upload-box {
        min-height: 200px;
    }
}

/* Optimisations pour l'orientation paysage sur mobile */
@media (max-height: 600px) and (orientation: landscape) {
    .hero-section {
        min-height: auto;
    }

    .hero-content {
        padding: var(--spacing-4) 0;
    }

    .key-metrics {
        grid-template-columns: repeat(4, 1fr);
    }

    .content-grid {
        gap: var(--spacing-4);
    }

    .submit-button {
        position: static;
        border-radius: var(--radius);
        margin: var(--spacing-4) 0;
    }
}

/* Améliorations pour l'accessibilité */
@media (prefers-reduced-motion: reduce) {
    * {
        animation: none !important;
        transition: none !important;
    }
}

/* Support pour le mode sombre du système */
@media (prefers-color-scheme: dark) {
    .file-upload-box {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
    }

    .motivation-input {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
        color: white;
    }
}

/* Styles des boutons d'action */
.btn-edit, .btn-delete {
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-edit {
    background-color: #4CAF50;
    color: white;
}

.btn-edit:hover {
    background-color: #45a049;
    transform: translateY(-2px);
}

.btn-delete {
    background-color: #f44336;
    color: white;
}

.btn-delete:hover {
    background-color: #da190b;
    transform: translateY(-2px);
}
</style>

<script>
function confirmDelete(id) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cette offre de stage ?")) {
        window.location.href = `/srx/internships/delete/${id}`;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Animation des compteurs
    const statValues = document.querySelectorAll('.stat-value[data-value]');
    
    const animateValue = (element, start, end, duration) => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const value = Math.floor(progress * (end - start) + start);
            element.textContent = value.toLocaleString();
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const endValue = parseInt(element.dataset.value);
                animateValue(element, 0, endValue, 2000);
                observer.unobserve(element);
            }
        });
    }, { threshold: 0.5 });

    statValues.forEach(value => observer.observe(value));

    // Animation des barres de progression
    const progressBars = document.querySelectorAll('.progress-bar');
    const progressObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const bar = entry.target;
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 100);
                progressObserver.unobserve(bar);
            }
        });
    }, { threshold: 0.5 });

    progressBars.forEach(bar => progressObserver.observe(bar));

    // Animation des sections au scroll
    const sections = document.querySelectorAll('.content-section, .company-card, .stats-card');
    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                sectionObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    sections.forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        sectionObserver.observe(section);
    });

    // Animation des métriques
    const metrics = document.querySelectorAll('.metric');
    metrics.forEach((metric, index) => {
        metric.style.animation = `float ${3 + index * 0.2}s ease-in-out infinite`;
    });
});

// File upload handling for both mobile and desktop
document.querySelectorAll('.file-input').forEach(input => {
    input.addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        if (fileName) {
            const placeholder = this.parentElement.querySelector('.upload-placeholder');
            placeholder.innerHTML = `
                <i class="fas fa-file-pdf"></i>
                <span>${fileName}</span>
            `;
        }
    });
});

// Drag and drop support for both mobile and desktop
document.querySelectorAll('.file-upload').forEach(fileUpload => {
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        fileUpload.addEventListener(eventName, preventDefaults, false);
    });

    ['dragenter', 'dragover'].forEach(eventName => {
        fileUpload.addEventListener(eventName, () => highlight(fileUpload), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        fileUpload.addEventListener(eventName, () => unhighlight(fileUpload), false);
    });

    fileUpload.addEventListener('drop', handleDrop, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

function highlight(element) {
    element.classList.add('border-primary');
}

function unhighlight(element) {
    element.classList.remove('border-primary');
}

function handleDrop(e) {
    const dt = e.dataTransfer;
    const file = dt.files[0];
    
    if (file && file.type === 'application/pdf') {
        input.files = dt.files;
        updateFileName(file);
    }
}

// Ajout de la fonction pour gérer le toggle des sections
function toggleSection(sectionId) {
    const content = document.getElementById(sectionId);
    const button = content.previousElementSibling;
    const icon = button.querySelector('.toggle-icon');
    
    // Toggle de la classe active
    content.classList.toggle('active');
    
    // Mise à jour de l'attribut aria-expanded
    const isExpanded = content.classList.contains('active');
    button.setAttribute('aria-expanded', isExpanded);
    
    // Animation de l'icône
    if (isExpanded) {
        content.style.display = 'block';
        setTimeout(() => {
            content.style.maxHeight = content.scrollHeight + 'px';
            content.style.opacity = '1';
        }, 10);
    } else {
        content.style.maxHeight = '0';
        content.style.opacity = '0';
        setTimeout(() => {
            content.style.display = 'none';
        }, 500);
    }
}

// Initialisation : ouvrir la première section par défaut
document.addEventListener('DOMContentLoaded', function() {
    toggleSection('description-content');
});
</script>