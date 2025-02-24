<?php
// Extraction des variables
if (isset($data)) {
    extract($data);
}

// Valeurs par défaut
$user_role = $user_role ?? '';
$companies = $companies ?? [];
?>

<!-- Header Section -->
<div class="page-header">
    <div class="container">
        <div class="header-content">
            <h1>Gestion des entreprises</h1>
            <p class="text-muted">Gérez les entreprises partenaires et leurs offres de stage</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchCompany" placeholder="Rechercher une entreprise...">
            </div>
            <?php if ($user_role === 'admin' || $user_role === 'pilote'): ?>
                <a href="/srx/companies/create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouvelle entreprise
                </a>
                <a href="/srx/companies/stats" class="btn btn-secondary">
                    <i class="fas fa-chart-bar"></i> Statistiques
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container">
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="alert alert-<?= $_SESSION['flash_message']['type'] ?>" role="alert">
            <i class="fas fa-info-circle"></i>
            <?= $_SESSION['flash_message']['message'] ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <div class="companies-grid">
        <?php if (!empty($companies)): ?>
            <?php foreach ($companies as $company): ?>
                <div class="company-card" data-name="<?= htmlspecialchars($company['name']) ?>" data-industry="<?= htmlspecialchars($company['industry'] ?? '') ?>">
                    <div class="company-card-header">
                        <div class="company-logo">
                            <i class="fas fa-building"></i>
                        </div>
                        <?php if (isset($company['rating'])): ?>
                            <div class="company-rating">
                                <i class="fas fa-star"></i>
                                <span><?= number_format($company['rating'], 1) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="company-card-body">
                        <h3 class="company-name"><?= htmlspecialchars($company['name']) ?></h3>
                        <p class="company-industry">
                            <i class="fas fa-industry"></i>
                            <?= htmlspecialchars($company['industry'] ?? 'Non spécifié') ?>
                        </p>
                        <p class="company-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <?= htmlspecialchars($company['city'] ?? '') ?>
                            <?= !empty($company['country']) ? ', ' . htmlspecialchars($company['country']) : '' ?>
                        </p>
                    </div>
                    <div class="company-card-actions">
                        <a href="/srx/companies/view/<?= $company['id'] ?>" class="btn btn-icon btn-view" title="Voir">
                            <i class="fas fa-eye"></i>
                        </a>
                        <?php if ($user_role === 'admin' || $user_role === 'pilote'): ?>
                            <a href="/srx/companies/edit/<?= $company['id'] ?>" class="btn btn-icon btn-edit" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-icon btn-delete" title="Supprimer" 
                                    onclick="confirmDelete(<?= $company['id'] ?>, '<?= htmlspecialchars($company['name']) ?>')">
                                <i class="fas fa-trash"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-building"></i>
                <h3>Aucune entreprise trouvée</h3>
                <?php if ($user_role === 'admin' || $user_role === 'pilote'): ?>
                    <p>Commencez par ajouter une nouvelle entreprise</p>
                    <a href="/srx/companies/create" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nouvelle entreprise
                    </a>
                <?php else: ?>
                    <p>Aucune entreprise n'est disponible pour le moment</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
/* Companies Grid */
.companies-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

/* Company Card */
.company-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.company-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.company-card-header {
    padding: 1.5rem;
    background: linear-gradient(45deg, var(--primary), var(--secondary));
    color: white;
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.company-logo {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.company-rating {
    background: rgba(255,255,255,0.2);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.company-rating i {
    color: #fbbf24;
}

.company-card-body {
    padding: 1.5rem;
}

.company-name {
    font-size: 1.25rem;
    margin-bottom: 1rem;
}

.company-industry,
.company-location {
    color: var(--gray);
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.company-card-actions {
    padding: 1rem 1.5rem;
    background: #f8fafc;
    display: flex;
    gap: 0.5rem;
    justify-content: flex-end;
}

/* Additional Button */
.btn-view {
    background: #e0f2fe;
    color: #0ea5e9;
}

.btn-view:hover {
    background: #0ea5e9;
    color: white;
}
</style>

<script>
// Recherche en temps réel
document.getElementById('searchCompany').addEventListener('input', function(e) {
    const searchValue = e.target.value.toLowerCase();
    const companyCards = document.querySelectorAll('.company-card');
    
    companyCards.forEach(card => {
        const name = card.dataset.name.toLowerCase();
        const industry = card.dataset.industry.toLowerCase();
        
        if (name.includes(searchValue) || industry.includes(searchValue)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

// Confirmation de suppression
function confirmDelete(companyId, companyName) {
    if (confirm(`Êtes-vous sûr de vouloir supprimer l'entreprise "${companyName}" ?`)) {
        window.location.href = '/srx/companies/delete/' + companyId;
    }
}
</script>