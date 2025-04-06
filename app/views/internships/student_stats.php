<?php if (isset($data)) extract($data); ?>

<div class="stats-dashboard">
    <div class="hero-section">
        <div class="hero-content">
            <h1>Statistiques de <?= htmlspecialchars($student['username']) ?></h1>
            <p>Vue d'ensemble des activités et candidatures</p>
        </div>
    </div>

    <div class="container">
        <!-- Cartes de statistiques -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <div class="stat-info">
                    <h3>Candidatures</h3>
                    <p class="stat-value"><?= $stats['total_applications'] ?></p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-info">
                    <h3>Liste de souhaits</h3>
                    <p class="stat-value"><?= $stats['total_wishlist'] ?></p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>Acceptées</h3>
                    <p class="stat-value"><?= $stats['status_distribution']['accepted'] ?></p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3>En attente</h3>
                    <p class="stat-value"><?= $stats['status_distribution']['pending'] ?></p>
                </div>
            </div>
        </div>

        <!-- Liste des candidatures -->
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-list"></i>
                Candidatures récentes
            </h2>
            <?php if (!empty($stats['applications'])): ?>
                <div class="applications-list">
                    <?php foreach ($stats['applications'] as $application): ?>
                        <div class="application-card">
                            <div class="application-header">
                                <h3><?= htmlspecialchars($application['internship_title']) ?></h3>
                                <span class="status-badge status-<?= $application['status'] ?>">
                                    <?= ucfirst($application['status']) ?>
                                </span>
                            </div>
                            <div class="application-details">
                                <p class="company-name">
                                    <i class="fas fa-building"></i>
                                    <?= htmlspecialchars($application['company_name']) ?>
                                </p>
                                <p class="application-date">
                                    <i class="fas fa-calendar"></i>
                                    Postulé le <?= date('d/m/Y', strtotime($application['created_at'])) ?>
                                </p>
                            </div>
                            <div class="application-actions">
                                <a href="/srx/internships/view/<?= $application['internship_id'] ?>" class="btn-view">
                                    <i class="fas fa-eye"></i>
                                    Voir le stage
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>Aucune candidature pour le moment</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Liste de souhaits -->
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-heart"></i>
                Liste de souhaits
            </h2>
            <?php if (!empty($stats['wishlist'])): ?>
                <div class="wishlist-grid">
                    <?php foreach ($stats['wishlist'] as $item): ?>
                        <div class="wishlist-card">
                            <h3><?= htmlspecialchars($item['title']) ?></h3>
                            <p class="company-name">
                                <i class="fas fa-building"></i>
                                <?= htmlspecialchars($item['company_name']) ?>
                            </p>
                            <div class="wishlist-actions">
                                <a href="/srx/internships/view/<?= $item['id'] ?>" class="btn-view">
                                    <i class="fas fa-eye"></i>
                                    Voir le stage
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-heart-broken"></i>
                    <p>Aucun stage dans la liste de souhaits</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
:root {
    --primary: #3B82F6;
    --primary-dark: #1D4ED8;
    --success: #10B981;
    --warning: #F59E0B;
    --danger: #EF4444;
    --gray-50: #F9FAFB;
    --gray-100: #F3F4F6;
    --gray-200: #E5E7EB;
    --gray-300: #D1D5DB;
    --gray-600: #4B5563;
    --gray-700: #374151;
    --gray-800: #1F2937;
}

.stats-dashboard {
    min-height: 100vh;
    background: var(--gray-50);
}

.hero-section {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    padding: 4rem 0;
    color: white;
    text-align: center;
    margin-bottom: 2rem;
}

.hero-section h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.stats-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 1rem;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.stat-info h3 {
    color: var(--gray-600);
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--gray-800);
}

.content-section {
    background: white;
    border-radius: 1rem;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.section-title {
    font-size: 1.25rem;
    color: var(--gray-800);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.section-title i {
    color: var(--primary);
}

.applications-list {
    display: grid;
    gap: 1rem;
}

.application-card {
    border: 1px solid var(--gray-200);
    border-radius: 0.75rem;
    padding: 1rem;
}

.application-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.application-header h3 {
    font-size: 1.125rem;
    color: var(--gray-800);
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.875rem;
    font-weight: 500;
}

.status-pending { background: var(--warning); color: white; }
.status-accepted { background: var(--success); color: white; }
.status-rejected { background: var(--danger); color: white; }

.application-details {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 1rem;
}

.application-details p {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--gray-600);
    font-size: 0.875rem;
}

.wishlist-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1rem;
}

.wishlist-card {
    border: 1px solid var(--gray-200);
    border-radius: 0.75rem;
    padding: 1rem;
}

.wishlist-card h3 {
    font-size: 1.125rem;
    color: var(--gray-800);
    margin-bottom: 0.5rem;
}

.btn-view {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    background: var(--primary);
    color: white;
    text-decoration: none;
    font-size: 0.875rem;
    transition: all 0.3s ease;
}

.btn-view:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
}

.empty-state {
    text-align: center;
    padding: 3rem;
    color: var(--gray-600);
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: var(--gray-300);
}

@media (max-width: 768px) {
    .hero-section {
        padding: 3rem 1rem;
    }

    .hero-section h1 {
        font-size: 2rem;
    }

    .stats-cards {
        grid-template-columns: 1fr;
    }

    .application-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .application-details {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>