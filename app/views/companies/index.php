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
        --primary: #4338CA;
        --secondary: #3B82F6;
        --background: #F9FAFB;
        --card-bg: #ffffff;
        --text-primary: #111827;
        --text-secondary: #6B7280;
        --success: #10B981;
        --danger: #EF4444;
        --border: #E5E7EB;
        --hover: #4F46E5;
    }

    body {
        background-color: var(--background);
        color: var(--text-primary);
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        padding: 3rem 0;
        margin-bottom: 2.5rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="none"/><circle cx="50" cy="50" r="40" stroke="rgba(255,255,255,0.1)" stroke-width="2" fill="none"/></svg>') repeat;
        opacity: 0.4;
    }

    .header-content {
        position: relative;
        z-index: 1;
        margin-bottom: 2rem;
    }

    .header-content h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: white;
    }

    .header-content p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 600px;
    }

    .header-actions {
        position: relative;
        z-index: 1;
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .btn i {
        font-size: 1.1rem;
    }

    .btn-primary {
        background: white;
        color: var(--primary);
        border: none;
    }

    .btn-primary:hover {
        background: var(--background);
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .search-box {
        position: relative;
        flex: 1;
        max-width: 400px;
    }

    .search-box input {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .search-box input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .search-box input:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
        outline: none;
    }

    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.6);
    }

    .companies-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
        padding: 0 1rem;
    }

    .company-card {
        background: var(--card-bg);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--border);
    }

    .company-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .company-card-header {
        padding: 1.75rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--border);
        background: linear-gradient(to right, rgba(67, 56, 202, 0.05), transparent);
    }

    .company-logo {
        width: 64px;
        height: 64px;
        background: var(--background);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--border);
        transition: all 0.3s ease;
    }

    .company-card:hover .company-logo {
        border-color: var(--primary);
        transform: scale(1.05);
    }

    .company-logo i {
        font-size: 2rem;
        color: var(--primary);
    }

    .company-rating {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(67, 56, 202, 0.1);
        padding: 0.75rem 1rem;
        border-radius: 12px;
        font-weight: 500;
    }

    .company-rating i {
        color: #FBBF24;
    }

    .company-card-body {
        padding: 2rem;
    }

    .company-name {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.25rem;
        color: var(--text-primary);
        line-height: 1.3;
    }

    .company-info {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .company-industry,
    .company-location {
        color: var(--text-secondary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.95rem;
    }

    .company-card-actions {
        padding: 1.5rem 2rem;
        background: var(--background);
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        border-top: 1px solid var(--border);
    }

    .btn-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border);
        background: white;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-icon:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--card-bg);
        border-radius: 20px;
        border: 2px dashed var(--border);
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--text-secondary);
        margin-bottom: 1.5rem;
        opacity: 0.5;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--text-primary);
    }

    .empty-state p {
        color: var(--text-secondary);
        max-width: 400px;
        margin: 0 auto;
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 2rem 0;
        }

        .header-content h1 {
            font-size: 2rem;
        }

        .companies-grid {
            grid-template-columns: 1fr;
            padding: 0 1rem;
        }

        .header-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box {
            max-width: none;
        }
    }
</style>

<!-- Header Section -->
<div class="page-header">
    <div class="container">
        <div class="header-content">
            <h1>Découvrez les entreprises</h1>
            <p>Explorez notre liste d'entreprises partenaires et trouvez votre prochaine opportunité professionnelle.</p>
        </div>
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

<!-- Main Content -->
<div class="container">
    <div class="companies-grid" id="companiesGrid">
        <?php if (empty($companies)): ?>
            <div class="empty-state">
                <i class="fas fa-building"></i>
                <h3>Aucune entreprise trouvée</h3>
                <p>Il n'y a pas encore d'entreprises enregistrées. Commencez par en ajouter une !</p>
            </div>
        <?php else: ?>
            <?php foreach ($companies as $company): ?>
                <div class="company-card">
                    <div class="company-card-header">
                        <div class="company-logo">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="company-rating">
                            <i class="fas fa-star"></i>
                            <span><?= htmlspecialchars($company['rating']) ?></span>
                        </div>
                    </div>
                    <div class="company-card-body">
                        <h2 class="company-name"><?= htmlspecialchars($company['name']) ?></h2>
                        <div class="company-info">
                            <div class="company-industry">
                                <i class="fas fa-briefcase"></i>
                                <span><?= htmlspecialchars($company['industry']) ?></span>
                            </div>
                            <?php 
                            $location = array_filter([
                                $company['city'] ?? null,
                                $company['country'] ?? null
                            ]);
                            if (!empty($location)): 
                            ?>
                                <div class="company-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?= htmlspecialchars(implode(', ', $location)) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="company-card-actions">
                        <a href="/srx/companies/view/<?= $company['id'] ?>" class="btn-icon" title="Voir les détails">
                            <i class="fas fa-eye"></i>
                        </a>
                        <?php if (in_array($user_role, ['admin', 'pilote'])): ?>
                            <a href="/srx/companies/edit/<?= $company['id'] ?>" class="btn-icon" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <?php if ($user_role === 'admin'): ?>
                                <button onclick="deleteCompany(<?= $company['id'] ?>)" class="btn-icon" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            <?php endif; ?>
                        <?php endif; ?>
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
        const industry = card.querySelector('.company-industry span').textContent.toLowerCase();
        const location = card.querySelector('.company-location span')?.textContent.toLowerCase();
        
        if (name.includes(searchTerm) || industry.includes(searchTerm) || (location && location.includes(searchTerm))) {
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