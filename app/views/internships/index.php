<!-- Header Section -->
<div class="page-header">
    <div class="container">
        <div class="header-content">
            <h1>Offres de stage</h1>
            <p class="text-muted">Découvrez les opportunités de stage disponibles</p>
        </div>
        <div class="header-actions">
            <?php if ($_SESSION['user']['role'] !== 'student'): ?>
                <a href="/srx/internships/stats" class="btn btn-secondary">
                    <i class="fas fa-chart-bar"></i> Statistiques
                </a>
                <a href="/srx/internships/create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouvelle offre
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container">
    <!-- Filtres -->
    <div class="filters-section">
        <div class="filter-group">
            <div class="icon-input">
                <i class="fas fa-building"></i>
                <select id="companyFilter" class="form-control">
                    <option value="">Toutes les entreprises</option>
                    <?php foreach ($companies as $company): ?>
                        <option value="<?= $company['id'] ?>" 
                                <?= isset($_GET['company_id']) && $_GET['company_id'] == $company['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($company['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="filter-group">
            <div class="icon-input">
                <i class="fas fa-tools"></i>
                <input type="text" id="skillsFilter" class="form-control" 
                       placeholder="Filtrer par compétences..." 
                       value="<?= htmlspecialchars($_GET['skills'] ?? '') ?>">
            </div>
        </div>
        <div class="filter-group">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInternship" 
                       placeholder="Rechercher une offre..."
                       value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
            </div>
        </div>
    </div>

    <!-- Liste des offres -->
    <div class="internships-grid">
        <?php if (!empty($internships)): ?>
            <?php foreach ($internships as $internship): ?>
                <div class="internship-card">
                    <div class="internship-card-header">
                        <div class="company-logo">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="internship-duration">
                            <i class="fas fa-calendar-alt"></i>
                            <span><?= $internship['duration'] ?> mois</span>
                        </div>
                    </div>
                    <div class="internship-card-body">
                        <h3 class="internship-title"><?= htmlspecialchars($internship['title']) ?></h3>
                        <p class="company-name">
                            <i class="fas fa-building"></i>
                            <?= htmlspecialchars($internship['company_name']) ?>
                        </p>
                        <div class="internship-description">
                            <?= nl2br(htmlspecialchars(substr($internship['description'], 0, 200))) ?>...
                        </div>
                        <div class="skills-container">
                            <?php
                            $skills = explode(',', $internship['skills_required']);
                            foreach ($skills as $skill): ?>
                                <span class="skill-badge">
                                    <?= htmlspecialchars(trim($skill)) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                        <div class="internship-compensation">
                            <i class="fas fa-euro-sign"></i>
                            <?= number_format($internship['compensation'], 2) ?> € / mois
                        </div>
                    </div>
                    <div class="internship-card-actions">
                        <a href="/srx/internships/view/<?= $internship['id'] ?>" class="btn btn-icon btn-view" title="Voir">
                            <i class="fas fa-eye"></i>
                        </a>
                        <?php if ($_SESSION['user']['role'] !== 'student'): ?>
                            <a href="/srx/internships/edit/<?= $internship['id'] ?>" class="btn btn-icon btn-edit" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-icon btn-delete" title="Supprimer" 
                                    onclick="confirmDelete(<?= $internship['id'] ?>, '<?= htmlspecialchars($internship['title']) ?>')">
                                <i class="fas fa-trash"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-briefcase"></i>
                <h3>Aucune offre de stage trouvée</h3>
                <?php if ($_SESSION['user']['role'] !== 'student'): ?>
                    <p>Commencez par ajouter une nouvelle offre de stage</p>
                    <a href="/srx/internships/create" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nouvelle offre
                    </a>
                <?php else: ?>
                    <p>Aucune offre n'est disponible pour le moment</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
/* Filters Section */
.filters-section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.filter-group {
    position: relative;
}

.icon-input {
    position: relative;
}

.icon-input i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray);
    z-index: 1;
}

.icon-input select,
.icon-input input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 1px solid #e2e8f0;
    border-radius: 50px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background-color: white;
}

/* Internships Grid */
.internships-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

/* Internship Card */
.internship-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.internship-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.internship-card-header {
    padding: 1.5rem;
    background: linear-gradient(45deg, var(--primary), var(--secondary));
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.internship-duration {
    background: rgba(255,255,255,0.2);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.internship-card-body {
    padding: 1.5rem;
}

.internship-title {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    color: var(--primary);
}

.company-name {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--gray);
    margin-bottom: 1rem;
}

.internship-description {
    color: var(--gray);
    margin-bottom: 1rem;
    line-height: 1.6;
}

/* Skills */
.skills-container {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.skill-badge {
    background: #f1f5f9;
    color: var(--primary);
    padding: 0.4rem 0.8rem;
    border-radius: 50px;
    font-size: 0.85rem;
}

.internship-compensation {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #10b981;
    font-weight: 500;
    margin-top: 1rem;
}

.internship-card-actions {
    padding: 1rem 1.5rem;
    background: #f8fafc;
    display: flex;
    gap: 0.5rem;
    justify-content: flex-end;
}
</style>

<script>
// Fonction pour appliquer les filtres
function applyFilters() {
    const company = document.getElementById('companyFilter').value;
    const skills = document.getElementById('skillsFilter').value;
    const search = document.getElementById('searchInternship').value;
    
    window.location.href = `/srx/internships?company_id=${company}&skills=${encodeURIComponent(skills)}&q=${encodeURIComponent(search)}`;
}

// Écouteurs d'événements pour les filtres
document.getElementById('companyFilter').addEventListener('change', applyFilters);
document.getElementById('skillsFilter').addEventListener('input', debounce(applyFilters, 500));
document.getElementById('searchInternship').addEventListener('input', debounce(applyFilters, 500));

// Fonction debounce pour limiter les appels
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Confirmation de suppression
function confirmDelete(internshipId, internshipTitle) {
    if (confirm(`Êtes-vous sûr de vouloir supprimer l'offre "${internshipTitle}" ?`)) {
        window.location.href = '/srx/internships/delete/' + internshipId;
    }
}
</script>