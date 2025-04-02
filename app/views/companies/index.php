<?php
// Extraction des variables
if (isset($data)) {
    extract($data);
}

// Valeurs par défaut
$companies = $companies ?? [];
$user_role = $_SESSION['user']['role'] ?? '';
?>

<style>
:root {
    --primary: #2563eb;
    --primary-dark: #1e40af;
    --primary-light: #3b82f6;
    --dark: #1e293b;
    --light: #f8fafc;
    --background: #F9FAFB;
    --text-primary: #111827;
    --text-secondary: #6B7280;
    --border: #E5E7EB;
}

.hero-section {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    padding: 4rem 0;
    color: white;
    text-align: center;
    margin-bottom: 3rem;
}

.companies-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
    padding: 0 1rem;
}

.company-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: 1px solid var(--border);
    transition: all 0.3s ease;
}

.company-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
}

.company-header {
    background: var(--primary);
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
}

.company-logo {
    width: 48px;
    height: 48px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.company-logo i {
    font-size: 1.5rem;
}

.company-content {
    padding: 1.5rem;
}

.company-name {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 1rem;
}

.company-info {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
}

.info-item i {
    color: var(--primary);
}

.company-actions {
    display: flex;
    gap: 0.5rem;
    justify-content: flex-end;
}

.btn-icon {
    width: 35px;
    height: 35px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-secondary);
    background: white;
    border: 1px solid var(--border);
    transition: all 0.3s ease;
}

.btn-icon:hover {
    transform: translateY(-2px);
    color: white;
}

.btn-view:hover { background: var(--primary); }
.btn-edit:hover { background: #fbbf24; }
.btn-delete:hover { background: #ef4444; }

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    grid-column: 1 / -1;
}

.search-container {
    max-width: 800px;
    margin: -2rem auto 3rem;
    padding: 0 1rem;
}

.search-box {
    background: white;
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

@media (max-width: 768px) {
    .hero-section { padding: 2rem 0; }
    .company-info { grid-template-columns: 1fr; }
}
</style>

<div class="hero-section">
    <div class="container">
        <h1>Découvrez les entreprises</h1>
        <p>Explorez notre liste d'entreprises partenaires et trouvez votre prochaine opportunité professionnelle.</p>
    </div>
</div>

<div class="search-container">
    <div class="search-box">
        <div class="header-actions">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Rechercher une entreprise..." id="searchInput">
            </div>
            <?php if ($user_role === 'admin'): ?>
                <a href="/srx/companies/create" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Ajouter une entreprise
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="companies-grid" id="companiesGrid">
        <?php if (empty($companies)): ?>
            <div class="empty-state">
                <i class="fas fa-building"></i>
                <h3>Aucune entreprise trouvée</h3>
                <p>Commencez par ajouter une entreprise !</p>
            </div>
        <?php else: ?>
            <?php foreach ($companies as $company): ?>
                <div class="company-card">
                    <div class="company-header">
                        <div class="company-logo">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="company-rating">
                            <i class="fas fa-star"></i>
                            <?= number_format($company['rating'] ?? 0, 1) ?> 
                            <span class="rating-count">(<?= $company['rating_count'] ?? 0 ?> avis)</span>
                        </div>
                    </div>
                    <div class="company-content">
                        <h3 class="company-name"><?= htmlspecialchars($company['name']) ?></h3>
                        <div class="company-info">
                            <div class="info-item">
                                <i class="fas fa-briefcase"></i>
                                <span><?= htmlspecialchars($company['industry']) ?></span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?= htmlspecialchars($company['city'] ?? '') ?></span>
                            </div>
                        </div>
                        <div class="company-actions">
                            <a href="/srx/companies/view/<?= $company['id'] ?>" class="btn-icon btn-view">
                                <i class="fas fa-eye"></i>
                            </a>
                            <?php if (in_array($user_role, ['admin', 'pilote'])): ?>
                                <a href="/srx/companies/edit/<?= $company['id'] ?>" class="btn-icon btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <?php if ($user_role === 'admin'): ?>
                                    <button onclick="deleteCompany(<?= $company['id'] ?>)" class="btn-icon btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const cards = document.querySelectorAll('.company-card');
    
    cards.forEach(card => {
        const name = card.querySelector('.company-name').textContent.toLowerCase();
        const industry = card.querySelector('.fa-briefcase + span').textContent.toLowerCase();
        const location = card.querySelector('.fa-map-marker-alt + span').textContent.toLowerCase();
        
        if (name.includes(searchTerm) || industry.includes(searchTerm) || location.includes(searchTerm)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});

function deleteCompany(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')) {
        window.location.href = '/srx/companies/delete/' + id;
    }
}
</script>