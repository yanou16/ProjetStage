<div class="hero-section">
    <div class="container">
        <h1 class="hero-title">Offres de stage</h1>
        <p class="hero-subtitle">Découvrez les opportunités de stage disponibles</p>
        
        <?php if ($_SESSION['user']['role'] !== 'student'): ?>
        <div class="header-actions">
            <a href="/srx/internships/stats" class="btn btn-secondary">
                <i class="fas fa-chart-bar"></i> Statistiques
            </a>
            <a href="/srx/internships/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nouvelle offre
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="page-container">
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
                        <div class="internship-header">
                            <div class="company-logo">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="duration">
                                <i class="fas fa-calendar"></i>
                                <?= $internship['duration'] ?> semaines
                            </div>
                        </div>

                        <div class="internship-body">
                            <h3 class="internship-title"><?= htmlspecialchars($internship['title']) ?></h3>
                            <div class="company-name">
                                <i class="fas fa-building"></i>
                                <?= htmlspecialchars($internship['company_name']) ?>
                            </div>
                            <p class="internship-description"><?= nl2br(htmlspecialchars(substr($internship['description'], 0, 200))) ?>...</p>
                            
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

                        <div class="internship-footer">
                            <a href="/srx/internships/view/<?= $internship['id'] ?>" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Voir le profil
                            </a>
                            <?php if ($_SESSION['user']['role'] !== 'student'): ?>
                                <a href="/srx/internships/edit/<?= $internship['id'] ?>" class="btn btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-delete" 
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
</div>

<style>
:root {
    --primary: #2563eb;
    --primary-dark: #1e40af;
    --white: #ffffff;
    --dark: #1e293b;
    --border: #e2e8f0;
    --text-secondary: #64748b;
    --success: #10b981;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    padding: 3rem 0;
    color: var(--white);
    text-align: center;
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 1.5rem;
}

.header-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 1.5rem;
}

/* Page Container */
.page-container {
    padding: 2rem 0;
    background: #f8fafc;
}

/* Filters Section */
.filters-section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
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
    color: var(--text-secondary);
    z-index: 1;
}

.icon-input select,
.icon-input input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 1px solid var(--border);
    border-radius: 50px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background-color: white;
}

.search-box {
    position: relative;
}

.search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-secondary);
}

.search-box input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 1px solid var(--border);
    border-radius: 50px;
}

/* Internships Grid */
.internships-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

/* Internship Card */
.internship-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.internship-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.internship-header {
    background: var(--primary);
    padding: 1.25rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: var(--white);
}

.company-logo {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.company-logo i {
    font-size: 1.25rem;
    color: var(--white);
}

.duration {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

.internship-body {
    padding: 1.25rem;
}

.internship-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 0.75rem;
}

.company-name {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.company-name i {
    color: var(--primary);
}

.internship-description {
    color: var(--text-secondary);
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 1rem;
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
    color: var(--success);
    font-weight: 500;
    margin-bottom: 1rem;
}

.internship-footer {
    padding: 1.25rem;
    background: var(--white);
    border-top: 1px solid var(--border);
    display: flex;
    gap: 0.5rem;
    justify-content: flex-end;
}

/* Buttons */
.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s ease;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: var(--primary);
    color: var(--white);
}

.btn-primary:hover {
    background: var(--primary-dark);
}

.btn-secondary {
    background: #e2e8f0;
    color: var(--dark);
}

.btn-secondary:hover {
    background: #cbd5e1;
}

.btn-edit {
    background: #fbbf24;
    color: white;
    padding: 0.75rem;
}

.btn-delete {
    background: #ef4444;
    color: white;
    padding: 0.75rem;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    grid-column: 1 / -1;
}

.empty-state i {
    font-size: 3rem;
    color: #60A5FA;
    margin-bottom: 1rem;
}

.empty-state h3 {
    color: #2D3748;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: #718096;
    margin-bottom: 1.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .internships-grid {
        grid-template-columns: 1fr;
        padding: 0 1rem;
    }
    
    .header-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
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