<?php
// Extraction des variables
if (isset($data)) {
    extract($data);
}
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-shape"></div>
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Votre carrière professionnelle commence ici</h1>
            <p class="hero-text">Découvrez des centaines d'offres de stage adaptées à votre profil et lancez-vous dans l'expérience qui transformera votre avenir.</p>
            <div class="hero-actions">
                <a href="/srx/internships" class="btn btn-primary">
                    <i class="fas fa-search"></i> Explorer les stages
                </a>
                <?php if (!isset($_SESSION['user'])): ?>
                    <a href="/srx/auth/login" class="btn btn-outline">
                        <i class="fas fa-user"></i> Se connecter
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="hero-image">
            <img src="/srx/public/img/hero.svg" alt="Illustration" class="floating">
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="container">
        <h2 class="section-title">Notre impact en chiffres</h2>
        <div class="stats-grid">
            <div class="stat-card" data-aos="fade-up" data-aos-delay="0">
                <div class="stat-icon">
                    <i class="fas fa-building"></i>
                </div>
                <h3>850+</h3>
                <p>Entreprises partenaires</p>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3>1200+</h3>
                <p>Offres actives</p>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-icon">
                    <i class="fas fa-smile"></i>
                </div>
                <h3>95%</h3>
                <p>De satisfaction</p>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>24h</h3>
                <p>Réponse moyenne</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features">
    <div class="container">
        <h2 class="section-title">Pourquoi choisir notre plateforme ?</h2>
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up">
                <div class="feature-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3>Recherche avancée</h3>
                <p>Trouvez des offres par compétences, localisation ou secteur d'activité.</p>
            </div>
            <div class="feature-card" data-aos="fade-up">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Tableau de bord</h3>
                <p>Suivez vos candidatures et statistiques en temps réel.</p>
            </div>
            <div class="feature-card" data-aos="fade-up">
                <div class="feature-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3>Gestion simplifiée</h3>
                <p>Créez et gérez votre profil professionnel en quelques clics.</p>
            </div>
            <div class="feature-card" data-aos="fade-up">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Sécurité des données</h3>
                <p>Plateforme conforme RGPD avec chiffrement des données.</p>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="partners">
    <div class="container">
        <h2 class="section-title">Nos entreprises partenaires</h2>
        <div class="partners-slider">
            <div class="partners-track">
                <div class="partner-logo">
                    <img src="/srx/public/img/companies/microsoft.png" alt="Microsoft">
                </div>
                <div class="partner-logo">
                    <img src="/srx/public/img/companies/apple.png" alt="Apple">
                </div>
                <div class="partner-logo">
                    <img src="/srx/public/img/companies/google.png" alt="Google">
                </div>
                <div class="partner-logo">
                    <img src="/srx/public/img/companies/meta.png" alt="Meta">
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Hero Section */
.hero {
    position: relative;
    padding: 6rem 0;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: white;
    overflow: hidden;
}

.hero-shape {
    position: absolute;
    top: 0;
    right: 0;
    width: 50%;
    height: 100%;
    background: rgba(255,255,255,0.1);
    clip-path: polygon(20% 0, 100% 0, 100% 100%, 0% 100%);
}

.hero .container {
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
}

.hero-text {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.hero-actions {
    display: flex;
    gap: 1rem;
}

.hero-image {
    position: relative;
}

.floating {
    animation: floating 3s ease-in-out infinite;
}

@keyframes floating {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0px); }
}

/* Stats Section */
.stats {
    padding: 6rem 0;
    background: white;
}

.section-title {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 3rem;
    color: var(--dark);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.stat-card {
    text-align: center;
    padding: 2rem;
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-icon {
    font-size: 2.5rem;
    color: var(--primary);
    margin-bottom: 1rem;
}

.stat-card h3 {
    font-size: 2.5rem;
    color: var(--primary);
    margin-bottom: 0.5rem;
}

/* Features Section */
.features {
    padding: 6rem 0;
    background: var(--light);
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.feature-card {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    text-align: center;
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.feature-icon {
    font-size: 2rem;
    color: var(--primary);
    margin-bottom: 1.5rem;
}

/* Partners Section */
.partners {
    padding: 6rem 0;
    background: white;
}

.partners-slider {
    overflow: hidden;
    padding: 2rem 0;
}

.partners-track {
    display: flex;
    animation: slide 20s linear infinite;
}

.partner-logo {
    flex: 0 0 250px;
    padding: 2rem;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.partner-logo:hover {
    opacity: 1;
}

.partner-logo img {
    max-width: 100%;
    height: auto;
}

@keyframes slide {
    0% { transform: translateX(0); }
    100% { transform: translateX(-100%); }
}

/* Responsive */
@media (max-width: 992px) {
    .hero .container {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .hero-actions {
        justify-content: center;
    }

    .hero-image {
        display: none;
    }

    .hero-title {
        font-size: 2.5rem;
    }
}

@media (max-width: 768px) {
    .section-title {
        font-size: 2rem;
    }

    .stats-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 576px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>