<div class="hero-section">
    <div id="particles-js"></div>
    <div class="container hero-content">
        <h1 class="hero-title" data-aos="fade-up">
            <span class="gradient-text">Découvrez votre futur stage</span>
        </h1>
        <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">
            Des opportunités uniques pour lancer votre carrière
        </p>
        
        <div class="stats-counter" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-item">
                <div class="stat-value" id="internshipCount">
                    <?= count($internships) ?>
                </div>
                <div class="stat-label">Stages disponibles</div>
            </div>
            <div class="stat-item">
                <div class="stat-value" id="companyCount">
                    <?= count($companies) ?>
                </div>
                <div class="stat-label">Entreprises</div>
            </div>
        </div>
        
        <?php if ($_SESSION['user']['role'] !== 'student'): ?>
        <div class="header-actions" data-aos="fade-up" data-aos-delay="300">
            <a href="/srx/internships/stats" class="btn btn-glass">
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
        <!-- Filtres avec animation -->
        <div class="filters-section" data-aos="fade-down">
            <div class="search-box-wrapper">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInternship" 
                           placeholder="Rechercher par titre, entreprise ou compétences..."
                           value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                </div>
            </div>
            
            <div class="filters-advanced">
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
            </div>
        </div>

        <!-- Liste des offres avec animation -->
        <div class="internships-grid">
            <?php if (!empty($internships)): ?>
                <?php foreach ($internships as $index => $internship): ?>
                    <div class="internship-card" data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>">
                        <div class="card-shine"></div>
                        <div class="internship-header">
                            <div class="company-logo">
                                <?php
                                $colors = ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'];
                                $color = $colors[array_rand($colors)];
                                $initials = strtoupper(substr($internship['company_name'], 0, 2));
                                ?>
                                <div class="logo-circle" style="background: <?= $color ?>">
                                    <?= $initials ?>
                                </div>
                            </div>
                            <div class="internship-meta">
                                <div class="duration">
                                    <i class="fas fa-calendar"></i>
                                    <?= $internship['duration'] ?> semaines
                                </div>
                                <div class="compensation">
                                    <i class="fas fa-euro-sign"></i>
                                    <?= number_format($internship['compensation'], 2) ?> € / mois
                                </div>
                            </div>
                        </div>

                        <div class="internship-body">
                            <h3 class="internship-title"><?= htmlspecialchars($internship['title']) ?></h3>
                            <div class="company-name">
                                <i class="fas fa-building"></i>
                                <?= htmlspecialchars($internship['company_name']) ?>
                            </div>
                            <p class="internship-description">
                                <?= nl2br(htmlspecialchars(substr($internship['description'], 0, 150))) ?>...
                            </p>
                            
                            <div class="skills-container">
                                <?php
                                $skills = explode(',', $internship['skills_required']);
                                foreach ($skills as $skill): ?>
                                    <span class="skill-badge">
                                        <?= htmlspecialchars(trim($skill)) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="internship-footer">
                            <a href="/srx/internships/view/<?= $internship['id'] ?>" class="btn btn-primary btn-view">
                                <span class="btn-content">
                                    <i class="fas fa-eye"></i>
                                    <span>Voir le profil</span>
                                </span>
                            </a>
                            <?php if ($_SESSION['user']['role'] !== 'student'): ?>
                                <div class="admin-actions">
                                    <a href="/srx/internships/edit/<?= $internship['id'] ?>" class="btn btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-delete" 
                                            onclick="confirmDelete(<?= $internship['id'] ?>, '<?= htmlspecialchars($internship['title']) ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state" data-aos="fade-up">
                    <div class="empty-illustration">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3>Aucune offre de stage trouvée</h3>
                    <?php if ($_SESSION['user']['role'] !== 'student'): ?>
                        <p>Commencez par ajouter une nouvelle offre de stage</p>
                        <a href="/srx/internships/create" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nouvelle offre
                        </a>
                    <?php else: ?>
                        <p>Aucune offre n'est disponible pour le moment</p>
                        <p class="empty-subtitle">Revenez plus tard pour découvrir de nouvelles opportunités</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
:root {
    --primary: #2563eb;
    --primary-dark: #1e40af;
    --primary-light: #60a5fa;
    --white: #ffffff;
    --dark: #1e293b;
    --border: #e2e8f0;
    --text-secondary: #64748b;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --purple: #8b5cf6;
}

/* Hero Section */
.hero-section {
    position: relative;
    background: linear-gradient(135deg, #1e1b4b, #312e81);
    padding: 6rem 0;
    color: var(--white);
    text-align: center;
    overflow: hidden;
}

#particles-js {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.gradient-text {
    background: linear-gradient(135deg, #60a5fa, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    color: transparent;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
}

.hero-subtitle {
    font-size: 1.25rem;
    opacity: 0.9;
    margin-bottom: 2rem;
    font-weight: 400;
}

.stats-counter {
    display: flex;
    justify-content: center;
    gap: 3rem;
    margin: 2rem 0;
}

.stat-item {
    text-align: center;
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-light);
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.8);
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: var(--primary);
    color: var(--white);
}

.btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

.btn-glass {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: var(--white);
}

.btn-glass:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

/* Filters Section */
.filters-section {
    background: var(--white);
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    margin: -4rem 2rem 2rem;
    position: relative;
    z-index: 3;
}

.search-box-wrapper {
    margin-bottom: 1.5rem;
}

.search-box {
    position: relative;
    max-width: 600px;
    margin: 0 auto;
}

.search-box input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid var(--border);
    border-radius: 50px;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.search-box input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    outline: none;
}

.search-box i {
    position: absolute;
    left: 1.25rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-secondary);
    font-size: 1.1rem;
}

.filters-advanced {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

/* Internships Grid */
.internships-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
    padding: 2rem;
}

/* Internship Card */
.internship-card {
    position: relative;
    background: var(--white);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid var(--border);
}

.internship-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.card-shine {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 200%;
    background: linear-gradient(
        45deg,
        transparent 45%,
        rgba(255, 255, 255, 0.1) 47%,
        rgba(255, 255, 255, 0.2) 50%,
        rgba(255, 255, 255, 0.1) 53%,
        transparent 55%
    );
    transform: translateX(-100%) translateY(-25%) rotate(0deg);
    animation: shine 10s ease-in-out infinite;
}

.internship-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: var(--white);
}

.logo-circle {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 1.2rem;
    color: var(--white);
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.internship-meta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    text-align: right;
}

.internship-body {
    padding: 1.5rem;
}

.internship-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 0.75rem;
}

.company-name {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
    font-size: 1rem;
    margin-bottom: 1rem;
}

.internship-description {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.skills-container {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
}

.skill-badge {
    background: #f1f5f9;
    color: var(--primary);
    padding: 0.4rem 1rem;
    border-radius: 50px;
    font-size: 0.875rem;
    transition: all 0.3s ease;
}

.skill-badge:hover {
    background: var(--primary);
    color: var(--white);
    transform: translateY(-2px);
}

.internship-footer {
    padding: 1.5rem;
    background: #f8fafc;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn-view {
    position: relative;
    overflow: hidden;
}

.btn-view .btn-content {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-view::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transform: translateX(-100%);
}

.btn-view:hover::before {
    animation: shine 1.5s infinite;
}

.admin-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-edit,
.btn-delete {
    padding: 0.5rem;
    border-radius: 8px;
    color: var(--text-secondary);
    transition: all 0.3s ease;
}

.btn-edit:hover {
    color: var(--primary);
    background: rgba(37, 99, 235, 0.1);
}

.btn-delete:hover {
    color: var(--danger);
    background: rgba(239, 68, 68, 0.1);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: var(--white);
    border-radius: 16px;
    border: 2px dashed var(--border);
}

.empty-illustration {
    font-size: 4rem;
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
    opacity: 0.5;
}

.empty-state h3 {
    font-size: 1.5rem;
    color: var(--dark);
    margin-bottom: 1rem;
}

.empty-state p {
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
}

.empty-subtitle {
    font-size: 0.875rem;
    opacity: 0.7;
}

/* Animations */
@keyframes shine {
    0% {
        transform: translateX(-100%) translateY(-25%) rotate(0deg);
    }
    20%, 100% {
        transform: translateX(100%) translateY(-25%) rotate(0deg);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .stats-counter {
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .filters-section {
        margin: -2rem 1rem 1rem;
        padding: 1.5rem;
    }
    
    .internships-grid {
        grid-template-columns: 1fr;
        padding: 1rem;
    }
}
</style>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialisation des animations AOS
    AOS.init({
        duration: 800,
        once: true
    });
    
    // Configuration de Particles.js
    particlesJS('particles-js', {
        particles: {
            number: {
                value: 80,
                density: {
                    enable: true,
                    value_area: 800
                }
            },
            color: {
                value: '#ffffff'
            },
            shape: {
                type: 'circle'
            },
            opacity: {
                value: 0.5,
                random: false
            },
            size: {
                value: 3,
                random: true
            },
            line_linked: {
                enable: true,
                distance: 150,
                color: '#ffffff',
                opacity: 0.4,
                width: 1
            },
            move: {
                enable: true,
                speed: 2,
                direction: 'none',
                random: false,
                straight: false,
                out_mode: 'out',
                bounce: false
            }
        },
        interactivity: {
            detect_on: 'canvas',
            events: {
                onhover: {
                    enable: true,
                    mode: 'grab'
                },
                onclick: {
                    enable: true,
                    mode: 'push'
                },
                resize: true
            },
            modes: {
                grab: {
                    distance: 140,
                    line_linked: {
                        opacity: 1
                    }
                },
                push: {
                    particles_nb: 4
                }
            }
        },
        retina_detect: true
    });
    
    // Animation des compteurs
    function animateValue(element, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            element.innerHTML = Math.floor(progress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }
    
    // Animer les compteurs
    const internshipCount = document.getElementById('internshipCount');
    const companyCount = document.getElementById('companyCount');
    
    animateValue(internshipCount, 0, parseInt(internshipCount.innerText), 2000);
    animateValue(companyCount, 0, parseInt(companyCount.innerText), 2000);
    
    // Gestion des filtres
    const searchInput = document.getElementById('searchInternship');
    const companyFilter = document.getElementById('companyFilter');
    const skillsFilter = document.getElementById('skillsFilter');
    
    function applyFilters() {
        const searchParams = new URLSearchParams(window.location.search);
        searchParams.set('q', searchInput.value);
        searchParams.set('company_id', companyFilter.value);
        searchParams.set('skills', skillsFilter.value);
        window.location.search = searchParams.toString();
    }
    
    let debounceTimer;
    const debounce = (callback, time) => {
        window.clearTimeout(debounceTimer);
        debounceTimer = window.setTimeout(callback, time);
    };
    
    searchInput.addEventListener('input', () => debounce(applyFilters, 500));
    companyFilter.addEventListener('change', applyFilters);
    skillsFilter.addEventListener('input', () => debounce(applyFilters, 500));
});

function confirmDelete(id, title) {
    if (confirm(`Êtes-vous sûr de vouloir supprimer l'offre "${title}" ?`)) {
        window.location.href = `/srx/internships/delete/${id}`;
    }
}
</script>