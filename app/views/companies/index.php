<?php
// Extraction des variables
if (isset($data)) {
    extract($data);
}

// Valeurs par défaut
$companies = $companies ?? [];
$user_role = $_SESSION['user']['role'] ?? '';

// Extraction des notes uniques (arrondi à l'entier le plus proche)
$ratings = array_unique(array_map(function($company) {
    return round($company['rating'] ?? 0);
}, $companies));
sort($ratings);

// Extraction des types de stages uniques
$internshipTypes = [];
foreach ($companies as $company) {
    if (isset($company['internships']) && is_array($company['internships'])) {
        foreach ($company['internships'] as $internship) {
            if (isset($internship['title'])) {
                $internshipTypes[] = $internship['title'];
            }
        }
    }
}
$internshipTypes = array_unique($internshipTypes);
sort($internshipTypes);

// Extraction des localisations uniques
$locations = array_unique(array_filter(array_column($companies, 'contact_phone')));
sort($locations);
?>

<div class="page-header">
    <div class="header-content">
        <div class="header-title">
            <h1>Entreprises Partenaires</h1>
            <p class="subtitle">Découvrez notre réseau d'entreprises et leurs opportunités de stage</p>
        </div>
        <?php if (in_array($user_role, ['admin', 'pilote'])): ?>
            <a href="/srx/companies/create" class="btn-add">
                <i class="fas fa-plus"></i>
                <span>Nouvelle Entreprise</span>
            </a>
        <?php endif; ?>
    </div>

    <div class="search-wrapper">
        <div class="search-box">
            <div class="search-input">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Rechercher une entreprise...">
            </div>
            <div class="search-filters">
                <div class="filter">
                    <select id="ratingFilter">
                        <option value="">Noter l'entreprise</option>
                        <?php foreach ($ratings as $rating): ?>
                            <option value="<?= $rating ?>">
                                <?= $rating ?> étoiles et plus
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter">
                    <select id="stageFilter">
                        <option value="">Stages proposés</option>
                        <?php foreach ($internshipTypes as $type): ?>
                            <option value="<?= htmlspecialchars(strtolower($type)) ?>">
                                <?= htmlspecialchars($type) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter">
                    <select id="locationFilter">
                        <option value="">Localisation</option>
                        <?php foreach ($locations as $location): ?>
                            <option value="<?= htmlspecialchars(strtolower($location)) ?>">
                                <?= htmlspecialchars($location) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div id="activeFilters" class="active-filters"></div>
    </div>
</div>

<style>
/* Variables */
:root {
    --primary: #2563eb;
    --primary-dark: #1d4ed8;
    --primary-light: #60a5fa;
    --secondary: #64748b;
    --success: #10b981;
    --danger: #ef4444;
    --warning: #f59e0b;
    --background: #f8fafc;
    --surface: #ffffff;
    --text: #1e293b;
    --text-light: #64748b;
    --border: #e2e8f0;
    --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --radius: 12px;
}

/* Layout */
.page-header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    padding: 3rem 2rem;
    margin-bottom: 2rem;
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
    background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
}

.header-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    z-index: 1;
}

.header-title {
    color: white;
}

.header-title h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
}

.btn-add {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: white;
    color: var(--primary);
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius);
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: var(--shadow);
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

.search-wrapper {
    max-width: 1200px;
    margin: 2rem auto -4rem;
    padding: 0 1rem;
    position: relative;
    z-index: 2;
}

.search-box {
    background: var(--surface);
    padding: 1.5rem;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
}

.search-input {
    position: relative;
    margin-bottom: 1rem;
}

.search-input i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-light);
    font-size: 1.1rem;
}

.search-input input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid var(--border);
    border-radius: var(--radius);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.search-input input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.search-filters {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.filter {
    flex: 1;
    min-width: 200px;
}

.filter select {
    width: 100%;
    padding: 0.75rem 2.5rem 0.75rem 1rem;
    border: 2px solid var(--border);
    border-radius: var(--radius);
    background: var(--surface);
    font-size: 0.95rem;
    color: var(--text);
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 1rem;
    transition: all 0.3s ease;
}

.filter select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.active-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 1rem;
}

.filter-tag {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    font-size: 0.9rem;
    color: var(--text);
    transition: all 0.3s ease;
}

.filter-tag i {
    cursor: pointer;
    padding: 0.2rem;
    border-radius: 50%;
    color: var(--text-light);
    transition: all 0.3s ease;
}

.filter-tag:hover {
    border-color: var(--primary);
    background: rgba(37, 99, 235, 0.05);
}

.filter-tag:hover i {
    color: var(--danger);
    transform: scale(1.1);
}

/* Responsive */
@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    .search-filters {
        flex-direction: column;
    }

    .filter {
        width: 100%;
    }

    .btn-add {
        width: 100%;
        justify-content: center;
    }
}

/* Animation des cartes */
.company-card {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.6s forwards;
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

/* Message vide */
.empty-state {
    background: var(--surface);
    padding: 4rem 2rem;
    text-align: center;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
}

.empty-state i {
    font-size: 3rem;
    color: var(--text-light);
    margin-bottom: 1.5rem;
}

.empty-state h3 {
    color: var(--text);
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: var(--text-light);
}

/* Grid des entreprises */
.companies-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
    padding: 2rem;
    margin-top: 6rem;
}

/* Carte d'entreprise */
.company-card {
    background: var(--surface);
    border-radius: var(--radius);
    overflow: hidden;
    position: relative;
    transition: all 0.3s ease;
    border: 1px solid var(--border);
}

.company-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    border-color: var(--primary-light);
}

/* En-tête de la carte */
.company-header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    padding: 2rem;
    position: relative;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.company-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1'/%3E%3C/svg%3E");
    opacity: 0.5;
}

/* Logo de l'entreprise */
.company-logo {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 1;
    backdrop-filter: blur(8px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.company-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 1rem;
}

.default-logo {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: 700;
    color: white;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Note de l'entreprise */
.company-rating {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(8px);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.company-rating i {
    color: var(--warning);
}

.rating-count {
    font-size: 0.9rem;
    opacity: 0.8;
}

/* Contenu de la carte */
.company-content {
    padding: 2rem;
}

.company-name {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 1.5rem;
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
    height: 3px;
    background: var(--primary);
    border-radius: 3px;
    transition: width 0.3s ease;
}

.company-card:hover .company-name::after {
    width: 100px;
}

/* Informations de l'entreprise */
.company-info {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem;
    border-radius: var(--radius);
    background: var(--background);
    transition: all 0.3s ease;
}

.info-item:hover {
    background: rgba(37, 99, 235, 0.05);
    transform: translateX(5px);
}

.info-item i {
    font-size: 1.2rem;
    color: var(--primary);
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(37, 99, 235, 0.1);
    border-radius: 10px;
    transition: all 0.3s ease;
}

.info-item:hover i {
    background: var(--primary);
    color: white;
    transform: rotate(-10deg);
}

.info-item span {
    color: var(--text);
    font-size: 0.95rem;
    font-weight: 500;
}

/* Actions sur la carte */
.company-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border);
}

.btn-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-icon::before {
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

.btn-icon:hover::before {
    left: 100%;
}

.btn-view {
    background: var(--primary);
}

.btn-edit {
    background: var(--warning);
}

.btn-delete {
    background: var(--danger);
}

.btn-icon:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* Styles spécifiques par secteur */
.company-logo.tech {
    background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);
}

.company-logo.finance {
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
}

.company-logo.marketing {
    background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
}

.company-logo.consulting {
    background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
}

.company-logo.industrie {
    background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
}

.company-logo.commerce {
    background: linear-gradient(135deg, #EC4899 0%, #DB2777 100%);
}

/* Animations */
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

.company-card {
    animation: fadeInUp 0.6s ease-out forwards;
    }
    
/* Responsive */
@media (max-width: 1200px) {
    .companies-grid {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        padding: 1.5rem;
    }
}

@media (max-width: 768px) {
    .companies-grid {
        grid-template-columns: 1fr;
        padding: 1rem;
    }

    .company-info {
        grid-template-columns: 1fr;
    }

    .company-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }

    .company-rating {
        align-self: flex-end;
    }
}

/* Notification styles */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 1rem 2rem;
    border-radius: var(--radius);
    background: var(--surface);
    color: var(--text);
    box-shadow: var(--shadow);
    z-index: 1000;
    animation: slideIn 0.3s ease-out;
}

.notification.alert-success {
    background: var(--success);
    color: white;
}

.notification.alert-error {
    background: var(--danger);
    color: white;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Modal d'erreur */
.error-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    backdrop-filter: blur(5px);
}

.error-modal-content {
    background: var(--surface);
    padding: 2rem;
    border-radius: var(--radius);
    max-width: 500px;
    width: 90%;
    box-shadow: var(--shadow);
}

.error-modal h3 {
    color: var(--danger);
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.error-details {
    background: var(--background);
    padding: 1.5rem;
    border-radius: var(--radius);
    margin-bottom: 1.5rem;
    max-height: 300px;
    overflow-y: auto;
}

.error-details pre {
    margin: 0;
    white-space: pre-wrap;
    word-wrap: break-word;
    font-family: monospace;
    color: var(--text);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const ratingFilter = document.getElementById('ratingFilter');
    const stageFilter = document.getElementById('stageFilter');
    const locationFilter = document.getElementById('locationFilter');
    const activeFilters = document.getElementById('activeFilters');
    const companiesGrid = document.getElementById('companiesGrid');

    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    function updateActiveFilters() {
        activeFilters.innerHTML = '';
        const filters = [
            { value: searchInput.value, label: 'Recherche' },
            { value: ratingFilter.value, label: ratingFilter.options[ratingFilter.selectedIndex].text },
            { value: stageFilter.value, label: stageFilter.options[stageFilter.selectedIndex].text },
            { value: locationFilter.value, label: locationFilter.options[locationFilter.selectedIndex].text }
        ];

        filters.forEach(filter => {
            if (filter.value) {
                const tag = document.createElement('div');
                tag.className = 'filter-tag';
                tag.innerHTML = `
                    ${filter.label}
                    <i class="fas fa-times" data-filter="${filter.label}"></i>
                `;
                activeFilters.appendChild(tag);
            }
        });
    }

    function filterCompanies() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const minRating = parseFloat(ratingFilter.value) || 0;
        const stage = stageFilter.value.toLowerCase();
        const location = locationFilter.value.toLowerCase();

        const cards = document.querySelectorAll('.company-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const name = card.querySelector('.company-name')?.textContent.toLowerCase() || '';
            const rating = parseFloat(card.querySelector('.company-rating')?.textContent) || 0;
            const stages = card.querySelectorAll('.info-item .fa-graduation-cap + span');
            const phone = card.querySelector('.info-item .fa-map-marker-alt + span')?.textContent.toLowerCase() || '';
            
            // Vérification des stages
            let hasStage = false;
            stages.forEach(stageElement => {
                if (stageElement.textContent.toLowerCase().includes(stage)) {
                    hasStage = true;
                }
            });

            const matchesSearch = !searchTerm || name.includes(searchTerm);
            const matchesRating = rating >= minRating;
            const matchesStage = !stage || hasStage;
            const matchesLocation = !location || phone === location;

            if (matchesSearch && matchesRating && matchesStage && matchesLocation) {
                card.style.display = '';
                card.style.animation = 'fadeInUp 0.3s forwards';
                card.style.animationDelay = `${visibleCount * 0.1}s`;
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        updateActiveFilters();
        updateEmptyMessage(visibleCount === 0);
    }

    const debouncedFilter = debounce(filterCompanies, 300);

    // Event listeners
    searchInput.addEventListener('input', debouncedFilter);
    ratingFilter.addEventListener('change', filterCompanies);
    stageFilter.addEventListener('change', filterCompanies);
    locationFilter.addEventListener('change', filterCompanies);

    // Gestion des filtres actifs
    activeFilters.addEventListener('click', (e) => {
        if (e.target.classList.contains('fa-times')) {
            const filterType = e.target.dataset.filter;
            switch(filterType.toLowerCase()) {
                case 'recherche':
                    searchInput.value = '';
                    break;
                case ratingFilter.options[ratingFilter.selectedIndex].text.toLowerCase():
                    ratingFilter.value = '';
                    break;
                case stageFilter.options[stageFilter.selectedIndex].text.toLowerCase():
                    stageFilter.value = '';
                    break;
                case locationFilter.options[locationFilter.selectedIndex].text.toLowerCase():
                    locationFilter.value = '';
                    break;
            }
            filterCompanies();
        }
    });

    // Filtre initial
    filterCompanies();
});
</script>

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
                <div class="company-card" 
                    data-company-id="<?= $company['id'] ?>"
                    data-stage-type="<?= htmlspecialchars(strtolower($company['internships'][0]['type'] ?? '')) ?>">
                    <div class="company-header">
                        <div class="company-logo">
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
                                <span><?= htmlspecialchars($company['description']) ?></span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?= htmlspecialchars($company['contact_email'] ?? '') ?></span>
                            </div>
                            <?php if (!empty($company['internships'][0]['type'])): ?>
                            <div class="info-item">
                                <i class="fas fa-graduation-cap"></i>
                                <span><?= htmlspecialchars($company['internships'][0]['type']) ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="company-actions">
                            <a href="/srx/companies/view/<?= $company['id'] ?>" class="btn-icon btn-view" title="Voir les détails">
                                <i class="fas fa-eye"></i>
                            </a>
                            <?php if (in_array($user_role, ['admin', 'pilote'])): ?>
                                <a href="/srx/companies/edit/<?= $company['id'] ?>" class="btn-icon btn-edit" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                    <button onclick="deleteCompany(<?= $company['id'] ?>)" class="btn-icon btn-delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
function showErrorDetails(error) {
    let errorMessage = "Erreur lors de la suppression :\n\n";
    
    if (error.details && Array.isArray(error.details)) {
        error.details.forEach(detail => {
            if (detail.startsWith('Code:') || detail.startsWith('Message:') || detail.startsWith('Table:')) {
                errorMessage += detail + "\n";
            }
        });
    }

    // Créer une modal pour afficher l'erreur
    const modalHtml = `
        <div class="error-modal">
            <div class="error-modal-content">
                <h3>Erreur de suppression</h3>
                <div class="error-details">
                    <pre>${errorMessage}</pre>
                </div>
                <button onclick="closeErrorModal()" class="btn btn-primary">Fermer</button>
            </div>
        </div>
    `;

    // Ajouter la modal au body
    document.body.insertAdjacentHTML('beforeend', modalHtml);
}

function closeErrorModal() {
    const modal = document.querySelector('.error-modal');
    if (modal) {
        modal.remove();
    }
}

function deleteCompany(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')) {
        fetch(`/srx/companies/delete/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Suppression réussie
                const card = document.querySelector(`[data-company-id="${id}"]`);
                if (card) {
                    card.classList.add('fade-out');
                    setTimeout(() => {
                        card.remove();
                        // Vérifier s'il reste des entreprises
                        const remainingCards = document.querySelectorAll('.company-card');
                        if (remainingCards.length === 0) {
                            const grid = document.getElementById('companiesGrid');
                            grid.innerHTML = `
                                <div class="empty-state">
                                    <i class="fas fa-building"></i>
                                    <h3>Aucune entreprise trouvée</h3>
                                    <p>Commencez par ajouter votre première entreprise partenaire !</p>
                                </div>
                            `;
                        }
                    }, 300);
                }
                showNotification('success', data.message);
            } else {
                // Erreur lors de la suppression
                showErrorDetails(data);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showErrorDetails({
                details: ['Message: Une erreur inattendue est survenue lors de la suppression.']
            });
        });
    }
}

function showNotification(type, message) {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} notification`;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
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