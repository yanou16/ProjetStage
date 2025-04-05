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
    --primary-blue: #60A5FA;
    --primary-dark: #3B82F6;
    --primary-light: #93C5FD;
    --text-white: #FFFFFF;
    --text-light: #F0F9FF;
    --bg-blue: #2563EB;
    --bg-light-blue: #60A5FA;
    --bg-dark: #0F172A;
    --bg-darker: #020617;
    --success-green: #10B981;
    --warning-yellow: #F59E0B;
    --danger-red: #EF4444;
    --gray-100: #F3F4F6;
    --gray-200: #E5E7EB;
    --gray-300: #D1D5DB;
    --gray-600: #4B5563;
    --gray-800: #1F2937;
}

/* Hero Section */
.hero-section {
    position: relative;
    background: linear-gradient(135deg, var(--bg-blue) 0%, var(--primary-dark) 100%);
    padding: 6rem 0 8rem;
    color: var(--text-white);
    text-align: center;
    overflow: hidden;
}

.hero-bg {
    position: absolute;
    inset: 0;
    overflow: hidden;
}

.hero-waves {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100px;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') repeat-x bottom;
    background-size: 100% 100%;
}

.hero-content {
    position: relative;
    z-index: 1;
}

.hero-section h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.hero-section p {
    font-size: 1.25rem;
    max-width: 600px;
    margin: 0 auto;
    opacity: 0.9;
}

/* Search Section */
.search-container {
    max-width: 800px;
    margin: -3rem auto 4rem;
    padding: 0 2rem;
    position: relative;
    z-index: 2;
}

.search-box {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

.search-input-wrapper {
    flex-grow: 1;
    position: relative;
}

.search-input-wrapper i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-600);
    font-size: 1.2rem;
}

#searchInput {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid var(--gray-200);
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

#searchInput:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.1);
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-blue), var(--bg-blue));
    color: white;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
}

/* Companies Grid */
.companies-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
    padding: 0 2rem;
}

.company-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 
        0 10px 30px rgba(0, 0, 0, 0.1),
        0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.8);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.6s forwards;
    position: relative;
    backdrop-filter: blur(10px);
}

.company-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        rgba(255, 255, 255, 0.3) 0%,
        rgba(255, 255, 255, 0.1) 100%
    );
    opacity: 0;
    transition: opacity 0.5s ease;
}

.company-card:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow: 
        0 20px 40px rgba(0, 0, 0, 0.12),
        0 15px 20px rgba(37, 99, 235, 0.1);
}

.company-card:hover::before {
    opacity: 1;
}

.company-header {
    background: linear-gradient(
        135deg,
        var(--bg-blue) 0%,
        var(--primary-dark) 50%,
        var(--bg-blue) 100%
    );
    background-size: 200% 200%;
    padding: 2.5rem;
    position: relative;
    overflow: hidden;
    animation: gradientMove 8s ease infinite;
}

@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.company-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: 
        radial-gradient(
            circle at 50% -50%,
            rgba(255, 255, 255, 0.15) 0%,
            transparent 70%
        );
    animation: shine 5s linear infinite;
}

@keyframes shine {
    0% { transform: translateY(-100%) rotate(0deg); }
    100% { transform: translateY(100%) rotate(45deg); }
}

.company-logo {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 1;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    overflow: hidden;
}

.company-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 15px;
    transition: all 0.3s ease;
}

.company-logo.tech {
    background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);
}

.company-logo.finance {
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
}

.company-logo.marketing {
    background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
}

.company-logo.design {
    background: linear-gradient(135deg, #EC4899 0%, #DB2777 100%);
}

.company-logo.consulting {
    background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
}

.company-logo::before {
    content: '';
    position: absolute;
    width: 150%;
    height: 150%;
    background: linear-gradient(
        45deg,
        transparent,
        rgba(255, 255, 255, 0.3),
        transparent
    );
    transform: rotate(45deg) translate(-50%, -50%);
    animation: shimmer 3s infinite;
}

@keyframes shimmer {
    0% {
        transform: rotate(45deg) translate(-150%, -150%);
    }
    100% {
        transform: rotate(45deg) translate(150%, 150%);
    }
}

.company-logo:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.company-logo:hover img {
    transform: scale(1.1);
}

.default-logo {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    text-transform: uppercase;
    font-weight: bold;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.default-logo::after {
    content: '';
    position: absolute;
    inset: 0;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 15px;
    opacity: 0;
    transition: all 0.3s ease;
}

.company-logo:hover .default-logo::after {
    inset: 5px;
    opacity: 1;
}

.company-rating {
    position: absolute;
    top: 2.5rem;
    right: 2.5rem;
    background: rgba(255, 255, 255, 0.15);
    padding: 0.75rem 1.25rem;
    border-radius: 25px;
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--text-white);
    font-weight: 700;
    z-index: 1;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.company-rating:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.company-rating i {
    color: var(--warning-yellow);
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
}

.company-content {
    padding: 2.5rem;
    background: linear-gradient(
        180deg,
        rgba(255, 255, 255, 0.95) 0%,
        rgba(255, 255, 255, 0.98) 100%
    );
}

.company-name {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--gray-800);
    margin-bottom: 2rem;
    line-height: 1.3;
    position: relative;
    padding-bottom: 1rem;
}

.company-name::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-blue), var(--bg-blue));
    border-radius: 2px;
    transition: width 0.3s ease;
}

.company-card:hover .company-name::after {
    width: 100px;
}

.company-info {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
    margin-bottom: 2.5rem;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    color: var(--gray-600);
    font-size: 1.1rem;
    transition: all 0.3s ease;
    padding: 0.5rem;
    border-radius: 12px;
}

.info-item:hover {
    background: rgba(96, 165, 250, 0.1);
    transform: translateX(5px);
}

.info-item i {
    color: var(--primary-blue);
    font-size: 1.4rem;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(96, 165, 250, 0.1);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.info-item:hover i {
    background: var(--primary-blue);
    color: white;
    transform: rotate(-10deg);
}

.company-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding-top: 2rem;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}

.btn-icon {
    width: 45px;
    height: 45px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    border: none;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.btn-icon::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transform: translateX(-100%) rotate(45deg);
    transition: transform 0.6s ease;
}

.btn-icon:hover::before {
    transform: translateX(100%) rotate(45deg);
}

.btn-icon:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.btn-view {
    background: linear-gradient(135deg, var(--primary-blue), var(--bg-blue));
}

.btn-edit {
    background: linear-gradient(135deg, var(--warning-yellow), #F97316);
}

.btn-delete {
    background: linear-gradient(135deg, var(--danger-red), #DC2626);
}

.empty-state {
    text-align: center;
    padding: 6rem 2rem;
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    grid-column: 1 / -1;
}

.empty-state i {
    font-size: 4rem;
    color: var(--gray-300);
    margin-bottom: 1.5rem;
}

.empty-state h3 {
    font-size: 1.5rem;
    color: var(--gray-800);
    margin-bottom: 1rem;
}

.empty-state p {
    color: var(--gray-600);
}

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

@media (max-width: 1024px) {
    .hero-section h1 {
        font-size: 3rem;
    }
    
    .companies-grid {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    }
}

@media (max-width: 768px) {
    .hero-section {
        padding: 4rem 0 6rem;
    }
    
    .hero-section h1 {
        font-size: 2.5rem;
    }
    
    .search-container {
        padding: 0 1rem;
    }
    
    .header-actions {
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn-primary {
        width: 100%;
        justify-content: center;
    }
    
    .companies-grid {
        grid-template-columns: 1fr;
        padding: 0 1rem;
    }
    
    .company-info {
        grid-template-columns: 1fr;
    }
}

@media (prefers-reduced-motion: reduce) {
    .company-card {
        animation: none;
        opacity: 1;
        transform: none;
    }
    
    .company-card:hover {
        transform: none;
    }
    
    .company-header::before {
        animation: none;
    }
}
</style>

<section class="hero-section">
    <div class="hero-bg">
        <div class="hero-waves"></div>
    </div>
    <div class="hero-content">
        <div class="container">
            <h1>Découvrez nos Entreprises Partenaires</h1>
            <p>Explorez notre réseau d'entreprises de confiance et trouvez votre opportunité de stage idéale.</p>
        </div>
    </div>
</section>

<div class="search-container">
    <div class="search-box">
        <div class="header-actions">
            <div class="search-input-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Rechercher par nom, secteur ou localisation..." id="searchInput">
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
                <p>Commencez par ajouter votre première entreprise partenaire !</p>
            </div>
        <?php else: ?>
            <?php foreach ($companies as $company): ?>
                <div class="company-card">
                    <div class="company-header">
                        <div class="company-logo <?= strtolower($company['sector'] ?? 'tech') ?>">
                            <?= getCompanyLogo($company) ?>
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
                            <a href="/srx/companies/view/<?= $company['id'] ?>" class="btn-icon btn-view" title="Voir les détails">
                                <i class="fas fa-eye"></i>
                            </a>
                            <?php if (in_array($user_role, ['admin', 'pilote'])): ?>
                                <a href="/srx/companies/edit/<?= $company['id'] ?>" class="btn-icon btn-edit" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <?php if ($user_role === 'admin'): ?>
                                    <button onclick="deleteCompany(<?= $company['id'] ?>)" class="btn-icon btn-delete" title="Supprimer">
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
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes au scroll
    const cards = document.querySelectorAll('.company-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.6s forwards';
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });

    cards.forEach(card => {
        observer.observe(card);
    });

    // Fonction de recherche
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('.company-card');
        
        cards.forEach(card => {
            const name = card.querySelector('.company-name').textContent.toLowerCase();
            const industry = card.querySelector('.fa-briefcase + span').textContent.toLowerCase();
            const location = card.querySelector('.fa-map-marker-alt + span').textContent.toLowerCase();
            
            if (name.includes(searchTerm) || 
                industry.includes(searchTerm) || 
                location.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});

// Fonction de suppression
function deleteCompany(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')) {
        fetch(`/srx/companies/delete/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const card = document.querySelector(`[data-company-id="${id}"]`);
                card.style.animation = 'fadeOut 0.3s forwards';
                setTimeout(() => card.remove(), 300);
            } else {
                alert('Une erreur est survenue lors de la suppression.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de la suppression.');
        });
    }
}
</script>

<?php
function getDefaultLogo($companyName) {
    $firstLetter = strtoupper(substr($companyName, 0, 1));
    return "<div class='default-logo'>{$firstLetter}</div>";
}

function getCompanyLogo($company) {
    $name = strtolower($company['name']);
    $sector = strtolower($company['sector'] ?? 'retail');
    
    // Logos spécifiques pour certaines entreprises
    $specificLogos = [
        'loreal' => '/srx/public/assets/img/company-logos/loreal-logo.png',
        'amazon' => '/srx/public/assets/img/company-logos/amazon-logo.png',
        'microsoft' => '/srx/public/assets/img/company-logos/microsoft-logo.png',
        'google' => '/srx/public/assets/img/company-logos/google-logo.png'
    ];
    
    // Si l'entreprise a un logo spécifique
    if (isset($specificLogos[$name])) {
        return "<img src='{$specificLogos[$name]}' alt='{$company['name']} logo' class='company-logo-img'>";
    }
    
    // Sinon, utiliser le logo par défaut avec la première lettre
    return getDefaultLogo($company['name']);
}
?>