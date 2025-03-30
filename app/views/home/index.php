<?php
if (isset($data)) {
    extract($data);
}
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text-content">
                <h1 class="hero-title">Avec Stageflow construisez votre avenir dans le monde du travail</h1>
                <p class="hero-text">La plateforme qui connecte les étudiants ambitieux aux meilleures opportunités de stage en France.</p>
                
                <div class="hero-buttons">
                    <a href="/srx/internships" class="btn btn-primary">
                        <i class="fas fa-search"></i> Voir les offres
                    </a>
                    <a href="/srx/companies" class="btn btn-outline">
                        <i class="fas fa-building"></i> Entreprises
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">10K+</span>
                        <span class="stat-label">Étudiants</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">5K+</span>
                        <span class="stat-label">Stages</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">98%</span>
                        <span class="stat-label">Satisfaction</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features">
    <div class="container">
        <h2 class="section-title">Pourquoi choisir notre plateforme ?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3>Recherche avancée</h3>
                <p>Trouvez des offres par compétences, localisation ou secteur d'activité.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Tableau de bord</h3>
                <p>Suivez vos candidatures et statistiques en temps réel.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3>Gestion simplifiée</h3>
                <p>Créez et gérez votre profil professionnel en quelques clics.</p>
            </div>
        </div>
    </div>
</section>

<!-- Important Info Section -->
<section class="important-info">
    <div class="container">
        <h2 class="section-title">Informations clés pour votre recherche</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Environnement sécurisé</h3>
                <p>Données cryptées et conformité RGPD garantie. Nous protégeons vos informations personnelles.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Support réactif</h3>
                <p>Assistance 7j/7 par nos conseillers spécialisés. Réponse sous 24h maximum.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h3>Partenariats vérifiés</h3>
                <p>Entreprises et écoles partenaires rigoureusement sélectionnées pour votre sécurité.</p>
            </div>
        </div>
    </div>
</section>

<style>
:root {
    --primary: #2563eb;
    --primary-dark: #1e40af;
    --primary-light: #3b82f6;
    --dark: #1e293b;
    --light: #f8fafc;
    --white: #ffffff;
}

/* Hero Section */
.hero {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    min-height: 80vh;
    display: flex;
    align-items: center;
    color: var(--white);
    padding: 4rem 0;
    position: relative;
}

.hero .container {
    position: relative;
    z-index: 1;
}

.hero-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 1.5rem;
    color: var(--white);
}

.hero-text {
    font-size: 1.25rem;
    margin-bottom: 2.5rem;
    opacity: 0.9;
    line-height: 1.6;
}

.hero-buttons {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.btn {
    padding: 1rem 2rem;
    border-radius: 8px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-primary {
    background: var(--white);
    color: var(--primary);
    border: 2px solid transparent;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-outline {
    background: transparent;
    color: var(--white);
    border: 2px solid var(--white);
}

.btn-outline:hover {
    background: rgba(255, 255, 255, 0.1);
}

.hero-stats {
    display: flex;
    gap: 3rem;
    margin-top: 2rem;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    display: block;
    color: var(--white);
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

/* Features Section */
.features {
    padding: 6rem 0;
    background: var(--white);
}

.section-title {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 4rem;
    color: var(--dark);
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 3rem;
    max-width: 1200px;
    margin: 0 auto;
}

.feature-card {
    text-align: center;
    padding: 2rem;
    background: var(--white);
    border-radius: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-10px);
}

.feature-icon {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: var(--white);
    font-size: 1.5rem;
}

.feature-card h3 {
    font-size: 1.25rem;
    margin-bottom: 1rem;
    color: var(--dark);
}

.feature-card p {
    color: #64748b;
    line-height: 1.6;
}

/* Important Info Section */
.important-info {
    background: var(--primary);
    padding: 6rem 0;
    color: var(--white);
}

.important-info .section-title {
    color: var(--white);
}

.important-info .feature-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

.important-info .feature-card h3 {
    color: var(--white);
}

.important-info .feature-card p {
    color: rgba(255, 255, 255, 0.8);
}

.important-info .feature-icon {
    background: var(--white);
    color: var(--primary);
}

@media (max-width: 768px) {
    .hero-content {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .hero-buttons {
        flex-direction: column;
    }

    .features-grid,
    .important-info .features-grid {
        grid-template-columns: 1fr;
    }

    .section-title {
        font-size: 2rem;
    }

    .hero-title {
        font-size: 2.5rem;
    }
}
</style>