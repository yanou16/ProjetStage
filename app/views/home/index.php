<?php
if (isset($data)) {
    extract($data);
}
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-bg">
        <div class="stars"></div>
        <div class="gradient-overlay"></div>
    </div>
    
    <div class="container">
        <div class="hero-content">
            <div class="hero-text-content">
                <h1 class="hero-title animate-text">
                    <span class="blue-text">Avec Stageflow</span>
                    <span class="main-title">construisez votre avenir dans le monde du travail</span>
                </h1>

                <p class="hero-description animate-fade">
                    La plateforme qui connecte les étudiants ambitieux aux meilleures opportunités de stage en France.
                </p>

                <div class="hero-cta animate-fade">
                    <a href="/srx/internships" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        Voir les offres
                    </a>
                </div>

                <div class="stats-row animate-fade">
                    <div class="stat-item">
                        <span class="stat-number">1500+</span>
                        <span class="stat-label">Offres de stages</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">300+</span>
                        <span class="stat-label">Entreprises</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">95%</span>
                        <span class="stat-label">Réussite</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">8000+</span>
                        <span class="stat-label">Étudiants</span>
                    </div>
                </div>
            </div>

            <div class="hero-visual animate-fade">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135810.png" alt="Illustration" class="floating-image">
            </div>
        </div>
    </div>
</section>

<!-- Key Features Section -->
<section class="features">
    <div class="container">
        <h2 class="section-title">Informations clés pour votre recherche</h2>
        <div class="features-grid">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>Sécurité Garantie</h3>
                    </div>
                    <div class="flip-card-back">
                        <h3>Sécurité Garantie</h3>
                        <p>Protection maximale de vos données personnelles avec cryptage avancé et conformité RGPD.</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check"></i> Données cryptées</li>
                            <li><i class="fas fa-check"></i> Conformité RGPD</li>
                            <li><i class="fas fa-check"></i> Accès sécurisé</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3>Support 24/7</h3>
                    </div>
                    <div class="flip-card-back">
                        <h3>Support 24/7</h3>
                        <p>Une équipe dédiée à votre écoute pour vous accompagner à chaque étape.</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check"></i> Réponse rapide</li>
                            <li><i class="fas fa-check"></i> Assistance personnalisée</li>
                            <li><i class="fas fa-check"></i> Suivi continu</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <div class="feature-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h3>Partenaires Vérifiés</h3>
                    </div>
                    <div class="flip-card-back">
                        <h3>Partenaires Vérifiés</h3>
                        <p>Un réseau d'entreprises et d'écoles soigneusement sélectionnées pour votre réussite.</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check"></i> Entreprises certifiées</li>
                            <li><i class="fas fa-check"></i> Stages de qualité</li>
                            <li><i class="fas fa-check"></i> Suivi régulier</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="statistics">
    <div class="stats-bg">
        <div class="moving-gradient"></div>
        <div class="dots-pattern"></div>
    </div>
    <div class="container">
        <h2 class="section-title">Notre Impact en Chiffres</h2>
        <div class="stats-wrapper">
            <div class="stats-row">
                <div class="stat-item" data-value="8000">
                    <div class="stat-circle">
                        <svg viewBox="0 0 100 100">
                            <circle class="stat-circle-bg" cx="50" cy="50" r="45"/>
                            <circle class="stat-circle-progress" cx="50" cy="50" r="45"/>
                        </svg>
                        <div class="stat-content">
                            <div class="stat-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="stat-number">
                                <span class="counter">0</span>
                                <span class="plus">+</span>
                            </div>
                        </div>
                    </div>
                    <h3>Étudiants</h3>
                    <p>Inscrits sur notre plateforme</p>
                </div>

                <div class="stat-item" data-value="1500">
                    <div class="stat-circle">
                        <svg viewBox="0 0 100 100">
                            <circle class="stat-circle-bg" cx="50" cy="50" r="45"/>
                            <circle class="stat-circle-progress" cx="50" cy="50" r="45"/>
                        </svg>
                        <div class="stat-content">
                            <div class="stat-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="stat-number">
                                <span class="counter">0</span>
                                <span class="plus">+</span>
                            </div>
                        </div>
                    </div>
                    <h3>Stages</h3>
                    <p>Offres disponibles</p>
                </div>
            </div>

            <div class="stats-row">
                <div class="stat-item" data-value="300">
                    <div class="stat-circle">
                        <svg viewBox="0 0 100 100">
                            <circle class="stat-circle-bg" cx="50" cy="50" r="45"/>
                            <circle class="stat-circle-progress" cx="50" cy="50" r="45"/>
                        </svg>
                        <div class="stat-content">
                            <div class="stat-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="stat-number">
                                <span class="counter">0</span>
                                <span class="plus">+</span>
                            </div>
                        </div>
                    </div>
                    <h3>Entreprises</h3>
                    <p>Partenaires actifs</p>
                </div>

                <div class="stat-item" data-value="95">
                    <div class="stat-circle">
                        <svg viewBox="0 0 100 100">
                            <circle class="stat-circle-bg" cx="50" cy="50" r="45"/>
                            <circle class="stat-circle-progress" cx="50" cy="50" r="45"/>
                        </svg>
                        <div class="stat-content">
                            <div class="stat-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="stat-number">
                                <span class="counter">0</span>
                                <span>%</span>
                            </div>
                        </div>
                    </div>
                    <h3>Réussite</h3>
                    <p>Taux de satisfaction</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials" id="testimonials">
    <div class="container">
        <h2 class="section-title reveal-text">Ce qu'ils disent de nous</h2>
        <div class="testimonials-grid">
            <div class="testimonial-card instagram-post" data-delay="0">
                <div class="post-header">
                    <div class="user-info">
                        <div class="user-avatar">
                            <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Marie L." class="avatar-img">
                            <div class="verified-badge">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <div class="user-details">
                            <h3>Marie L.</h3>
                            <span>Étudiante en Marketing Digital</span>
                        </div>
                    </div>
                    <div class="post-time">
                        <i class="far fa-clock"></i>
                        <span>Il y a 2 jours</span>
                    </div>
                </div>

                <div class="post-content">
                    <div class="post-text typing-text">
                        <p>Grâce à Stageflow, j'ai trouvé mon stage de rêve en seulement 2 semaines. L'interface est intuitive et le support est très réactif. 🚀</p>
                    </div>
                    <div class="post-tags">
                        <span class="tag">#StageIdéal</span>
                        <span class="tag">#Stageflow</span>
                        <span class="tag">#Marketing</span>
                    </div>
                </div>

                <div class="post-stats">
                    <div class="stat-group">
                        <span class="stat">
                            <i class="fas fa-heart"></i>
                            2.4k
                        </span>
                        <span class="stat">
                            <i class="fas fa-comment"></i>
                            184
                        </span>
                        <span class="stat">
                            <i class="fas fa-share"></i>
                            56
                        </span>
                    </div>
                    <div class="post-rating">
                        <i class="fas fa-star"></i>
                        <span>4.8</span>
                    </div>
                </div>

                <div class="post-actions">
                    <button class="action-btn like-btn">
                        <i class="far fa-heart"></i>
                        <span>J'aime</span>
                    </button>
                    <button class="action-btn">
                        <i class="far fa-comment"></i>
                        <span>Commenter</span>
                    </button>
                    <button class="action-btn">
                        <i class="far fa-share-square"></i>
                        <span>Partager</span>
                    </button>
                </div>
            </div>

            <div class="testimonial-card instagram-post featured" data-delay="200">
                <div class="featured-badge">
                    <i class="fas fa-award"></i>
                    Avis du mois
                </div>
                <div class="post-header">
                    <div class="user-info">
                        <div class="user-avatar">
                            <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Thomas D." class="avatar-img">
                            <div class="verified-badge">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <div class="user-details">
                            <h3>Thomas D.</h3>
                            <span>DRH, Tech Solutions</span>
                        </div>
                    </div>
                    <div class="post-time">
                        <i class="far fa-clock"></i>
                        <span>Il y a 1 semaine</span>
                    </div>
                </div>

                <div class="post-content">
                    <div class="post-text typing-text">
                        <p>La plateforme nous permet de trouver rapidement des stagiaires qualifiés. Un vrai gain de temps pour notre processus de recrutement. 💼</p>
                    </div>
                    <div class="post-tags">
                        <span class="tag">#Recrutement</span>
                        <span class="tag">#RH</span>
                        <span class="tag">#Innovation</span>
                    </div>
                </div>

                <div class="post-stats">
                    <div class="stat-group">
                        <span class="stat">
                            <i class="fas fa-heart"></i>
                            3.1k
                        </span>
                        <span class="stat">
                            <i class="fas fa-comment"></i>
                            246
                        </span>
                        <span class="stat">
                            <i class="fas fa-share"></i>
                            89
                        </span>
                    </div>
                    <div class="post-rating">
                        <i class="fas fa-star"></i>
                        <span>4.9</span>
                    </div>
                </div>

                <div class="post-actions">
                    <button class="action-btn like-btn">
                        <i class="far fa-heart"></i>
                        <span>J'aime</span>
                    </button>
                    <button class="action-btn">
                        <i class="far fa-comment"></i>
                        <span>Commenter</span>
                    </button>
                    <button class="action-btn">
                        <i class="far fa-share-square"></i>
                        <span>Partager</span>
                    </button>
                </div>
            </div>

            <div class="testimonial-card instagram-post" data-delay="400">
                <div class="post-header">
                    <div class="user-info">
                        <div class="user-avatar">
                            <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="Sophie M." class="avatar-img">
                            <div class="verified-badge">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <div class="user-details">
                            <h3>Sophie M.</h3>
                            <span>Responsable des stages</span>
                        </div>
                    </div>
                    <div class="post-time">
                        <i class="far fa-clock"></i>
                        <span>Il y a 3 jours</span>
                    </div>
                </div>

                <div class="post-content">
                    <div class="post-text typing-text">
                        <p>Un excellent outil pour suivre les candidatures et gérer les relations avec les entreprises. Je recommande vivement ! 🌟</p>
                    </div>
                    <div class="post-tags">
                        <span class="tag">#Gestion</span>
                        <span class="tag">#Stages</span>
                        <span class="tag">#Recommandation</span>
                    </div>
                </div>

                <div class="post-stats">
                    <div class="stat-group">
                        <span class="stat">
                            <i class="fas fa-heart"></i>
                            2.8k
                        </span>
                        <span class="stat">
                            <i class="fas fa-comment"></i>
                            205
                        </span>
                        <span class="stat">
                            <i class="fas fa-share"></i>
                            72
                        </span>
                    </div>
                    <div class="post-rating">
                        <i class="fas fa-star"></i>
                        <span>4.7</span>
                    </div>
                </div>

                <div class="post-actions">
                    <button class="action-btn like-btn">
                        <i class="far fa-heart"></i>
                        <span>J'aime</span>
                    </button>
                    <button class="action-btn">
                        <i class="far fa-comment"></i>
                        <span>Commenter</span>
                    </button>
                    <button class="action-btn">
                        <i class="far fa-share-square"></i>
                        <span>Partager</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How it Works Section -->
<section class="how-it-works">
    <div class="container">
        <h2 class="section-title">Comment ça marche ?</h2>
        <div class="steps-timeline">
            <div class="timeline-line">
                <div class="progress-line"></div>
            </div>
            
            <div class="step-card" data-step="1">
                <div class="step-number">1</div>
                <div class="step-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="step-content">
                    <h3>Créez votre profil</h3>
                    <p>Inscrivez-vous gratuitement et complétez votre profil avec vos compétences et expériences.</p>
                    <a href="/srx/register" class="step-link">
                        <span>Commencer</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="step-card" data-step="2">
                <div class="step-number">2</div>
                <div class="step-icon">
                    <i class="fas fa-search"></i>
                </div>
                <div class="step-content">
                    <h3>Trouvez le stage idéal</h3>
                    <p>Utilisez nos filtres avancés pour trouver les offres qui correspondent à vos critères.</p>
                    <a href="/srx/internships" class="step-link">
                        <span>Explorer</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="step-card" data-step="3">
                <div class="step-number">3</div>
                <div class="step-icon">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <div class="step-content">
                    <h3>Postulez en un clic</h3>
                    <p>Envoyez votre candidature et suivez son état d'avancement en temps réel.</p>
                    <a href="/srx/register" class="step-link">
                        <span>Postuler</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="animated-background">
        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
        <div class="particles"></div>
    </div>
    <div class="container">
        <h2 class="glow-text">Prêt à lancer votre carrière ?</h2>
        <p>Rejoignez des milliers d'étudiants qui ont trouvé leur stage idéal avec Stageflow</p>
        <div class="cta-buttons">
            <a href="/srx/internships" class="btn btn-outline pulse-effect">
                <span>Parcourir les offres</span>
                <i class="fas fa-search"></i>
            </a>
        </div>
    </div>
</section>

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
    --gray-100: #F3F4F6;
    --gray-200: #E5E7EB;
    --gray-300: #D1D5DB;
    --gray-600: #4B5563;
    --gray-800: #1F2937;
}

.hero {
    position: relative;
    min-height: 100vh;
    background: linear-gradient(135deg, var(--bg-light-blue) 0%, var(--bg-blue) 100%);
    overflow: hidden;
    padding: 6rem 0;
    color: var(--text-white);
}

.hero-bg {
    position: absolute;
    inset: 0;
    overflow: hidden;
}

.stars {
    position: absolute;
    inset: 0;
    background-image: 
        radial-gradient(2px 2px at 20px 20px, rgba(255, 255, 255, 0.3) 100%, transparent),
        radial-gradient(2px 2px at 40px 70px, rgba(255, 255, 255, 0.3) 100%, transparent),
        radial-gradient(2px 2px at 60px 110px, rgba(255, 255, 255, 0.3) 100%, transparent);
    background-size: 100px 100px;
    animation: twinkle 8s ease-in-out infinite;
}

.gradient-overlay {
    position: absolute;
    inset: 0;
    overflow: hidden;
}

.gradient-overlay::before,
.gradient-overlay::after {
    content: '';
    position: absolute;
    width: 200%;
    height: 200%;
    top: -50%;
    left: -50%;
    background: linear-gradient(transparent, rgba(255, 255, 255, 0.2));
    transform-origin: 0 0;
    animation: wave 12s infinite linear;
    z-index: 1;
    border-radius: 40%;
}

.gradient-overlay::after {
    animation: wave 8s infinite linear;
    opacity: 0.5;
    background: linear-gradient(transparent, rgba(147, 197, 253, 0.3));
}

@keyframes wave {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

@keyframes twinkle {
    0%, 100% { 
        opacity: 0.3; 
        transform: scale(1);
    }
    50% { 
        opacity: 0.6; 
        transform: scale(1.2);
    }
}

.hero-content {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 4rem;
    align-items: center;
}

.hero-title {
    font-size: 4rem;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 1.5rem;
}

.blue-text {
    color: var(--text-white);
    text-shadow: 0 0 20px rgba(255, 255, 255, 0.4);
}

.main-title {
    display: block;
    color: var(--text-white);
}

.hero-description {
    font-size: 1.25rem;
    line-height: 1.6;
    color: var(--text-light);
    margin-bottom: 2.5rem;
    max-width: 90%;
}

.hero-cta {
    display: flex;
    gap: 1rem;
    margin-bottom: 3rem;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary {
    background: var(--text-white);
    color: var(--bg-blue);
    box-shadow: 0 4px 20px rgba(255, 255, 255, 0.3);
}

.btn-primary:hover {
    background: var(--text-light);
    transform: translateY(-2px);
}

.btn-outline {
    border: 2px solid var(--text-light);
    color: var(--text-white);
}

.btn-outline:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

.stats-row {
    display: flex;
    gap: 4rem;
}

.stat-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-white);
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.4);
    line-height: 1;
}

.stat-label {
    font-size: 0.875rem;
    color: var(--text-light);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.hero-visual {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

.floating-image {
    width: 400px;
    height: auto;
    filter: drop-shadow(0 0 25px rgba(255, 255, 255, 0.5));
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}

.animate-text {
    opacity: 0;
    transform: translateY(20px);
    animation: slideUp 0.8s ease-out forwards;
}

.animate-fade {
    opacity: 0;
    animation: fadeIn 0.8s ease-out forwards;
}

@keyframes slideUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    to {
        opacity: 1;
    }
}

@media (max-width: 1024px) {
    .hero-title {
        font-size: 3rem;
    }

    .hero-content {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .hero-description {
        margin: 0 auto 2.5rem;
    }

    .hero-cta {
        justify-content: center;
    }

    .stats-row {
        justify-content: center;
    }

    .floating-image {
        width: 300px;
    }
}

@media (max-width: 768px) {
    .hero {
        padding: 4rem 0;
    }

    .hero-title {
        font-size: 2.5rem;
    }

    .hero-cta {
        flex-direction: column;
    }

    .stats-row {
        flex-direction: column;
        align-items: center;
        gap: 2rem;
    }

    .stat-item {
        align-items: center;
    }

    .floating-image {
        width: 200px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .animate-fade,
    .animate-text,
    .stars {
        animation: none;
    }
}

/* Features Section with Flip Cards */
.features {
    padding: 6rem 0;
    background: linear-gradient(180deg, var(--bg-blue) 0%, var(--gray-100) 100%);
    position: relative;
    margin-top: -6rem;
    padding-top: 12rem;
}

.features .section-title {
    color: var(--text-white);
    text-align: center;
    margin-bottom: 4rem;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 3rem;
    max-width: 1200px;
    margin: 0 auto;
}

.flip-card {
    background-color: transparent;
    width: 100%;
    height: 400px;
    perspective: 1000px;
}

.flip-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    text-align: center;
    transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    transform-style: preserve-3d;
}

.flip-card:hover .flip-card-inner {
    transform: rotateY(180deg);
}

.flip-card-front, .flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 16px;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.flip-card-front {
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.flip-card-back {
    background: var(--bg-blue);
    color: var(--text-white);
    transform: rotateY(180deg);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
}

.flip-card-front .feature-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-light), var(--primary-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: var(--text-white);
    font-size: 2rem;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.flip-card-front h3 {
    font-size: 1.5rem;
    color: var(--gray-800);
    margin: 0;
}

.flip-card-back h3 {
    font-size: 1.5rem;
    color: var(--text-white);
    margin-bottom: 1rem;
}

.flip-card-back p {
    color: var(--text-light);
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.flip-card-back .feature-list {
    list-style: none;
    padding: 0;
    margin: 0;
    text-align: left;
    width: 100%;
}

.flip-card-back .feature-list li {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
    color: var(--text-light);
}

.flip-card-back .feature-list li i {
    color: var(--success-green);
}

@media (max-width: 1024px) {
    .features-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .flip-card {
        height: 350px;
    }
}

@media (max-width: 768px) {
    .features-grid {
        grid-template-columns: 1fr;
    }
    
    .flip-card {
        height: 300px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .flip-card-inner {
        transition: none;
    }
    
    .flip-card:hover .flip-card-inner {
        transform: none;
    }
    
    .flip-card-back {
        display: none;
    }
}

/* Testimonials Section */
.testimonials {
    padding: 6rem 0;
    background: #fafafa;
    position: relative;
    overflow: visible;
    z-index: 1;
}

.testimonials .section-title {
    text-align: center;
    margin-bottom: 4rem;
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--gray-800);
    position: relative;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    position: relative;
    z-index: 2;
}

.instagram-post {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    opacity: 0;
    transform: translateY(20px);
    display: flex;
    flex-direction: column;
}

.instagram-post.animate {
    opacity: 1;
    transform: translateY(0);
    animation: slideUp 0.6s ease forwards;
}

.instagram-post:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.featured {
    border: 2px solid var(--primary-light);
    position: relative;
}

.featured-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: linear-gradient(135deg, var(--primary-light), var(--primary-dark));
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    animation: pulse 2s infinite;
    z-index: 1;
}

.post-header {
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid var(--gray-200);
    background: white;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-avatar {
    position: relative;
    width: 48px;
    height: 48px;
    flex-shrink: 0;
}

.avatar-img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}

.verified-badge {
    position: absolute;
    bottom: -2px;
    right: -2px;
    width: 20px;
    height: 20px;
    background: var(--primary-dark);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.75rem;
    border: 2px solid white;
}

.user-details {
    flex-grow: 1;
    min-width: 0;
}

.user-details h3 {
    font-size: 1rem;
    font-weight: 600;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-details span {
    font-size: 0.875rem;
    color: var(--gray-600);
    display: block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.post-time {
    font-size: 0.875rem;
    color: var(--gray-600);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-shrink: 0;
}

.post-content {
    padding: 1.5rem;
    flex-grow: 1;
    background: white;
    position: relative;
    overflow: hidden;
}

.post-content::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(
        45deg,
        transparent,
        rgba(255, 255, 255, 0.1),
        transparent
    );
    transform: rotate(45deg);
    animation: shine 3s infinite;
}

.post-text {
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 1rem;
    opacity: 0;
}

.post-text.animate {
    opacity: 1;
    animation: fadeIn 0.6s ease forwards;
}

.post-text p {
    margin: 0;
}

.post-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 1rem;
}

.tag {
    background: var(--gray-100);
    color: var(--primary-dark);
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.875rem;
    transition: all 0.3s ease;
}

.tag:hover {
    background: var(--primary-light);
    color: white;
    transform: scale(1.05);
}

.post-stats {
    padding: 1rem;
    border-top: 1px solid var(--gray-200);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
}

.stat-group {
    display: flex;
    gap: 1.5rem;
}

.stat {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--gray-600);
    font-size: 0.875rem;
}

.post-rating {
    background: var(--warning-yellow);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.post-actions {
    padding: 1rem;
    border-top: 1px solid var(--gray-200);
    display: flex;
    justify-content: space-around;
    background: white;
}

.action-btn {
    background: none;
    border: none;
    color: var(--gray-600);
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    transition: all 0.3s ease;
}

.action-btn:hover {
    background: var(--gray-100);
    color: var(--primary-dark);
}

.action-btn.like-btn.liked {
    color: #e31b23;
}

.action-btn.like-btn.liked i {
    animation: heartBeat 0.3s ease;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@media (max-width: 1024px) {
    .testimonials-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .testimonials-grid {
        grid-template-columns: 1fr;
        padding: 0 1rem;
    }
    
    .instagram-post {
        max-width: 500px;
        margin: 0 auto;
    }
}

@media (prefers-reduced-motion: reduce) {
    .instagram-post {
        animation: none;
        opacity: 1;
        transform: none;
    }
    
    .instagram-post:hover {
        transform: none;
    }
    
    .featured-badge {
        animation: none;
    }
}

/* How it Works Section */
.how-it-works {
    padding: 8rem 0;
    background: linear-gradient(135deg, var(--bg-blue) 0%, var(--primary-dark) 100%);
    color: var(--text-white);
    position: relative;
    overflow: visible;
    margin-top: 2rem;
    z-index: 1;
}

.how-it-works .section-title {
    text-align: center;
    margin-bottom: 6rem;
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-white);
    position: relative;
    z-index: 2;
}

.steps-timeline {
    max-width: 900px;
    margin: 0 auto;
    position: relative;
    padding: 0 2rem;
    z-index: 2;
}

.timeline-line {
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 4px;
    background: rgba(255, 255, 255, 0.2);
    transform: translateX(-50%);
    border-radius: 2px;
}

.progress-line {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 0;
    background: linear-gradient(to bottom, var(--text-white), var(--primary-light));
    transition: height 1.5s ease;
    border-radius: 2px;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

.step-card {
    position: relative;
    width: calc(50% - 3rem);
    margin-bottom: 6rem;
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.step-card:nth-child(odd) {
    margin-left: auto;
    padding-left: 3rem;
}

.step-card:nth-child(even) {
    padding-right: 3rem;
}

.step-card.animate {
    opacity: 1;
    transform: translateY(0);
}

.step-number {
    position: absolute;
    top: 50%;
    width: 60px;
    height: 60px;
    background: var(--text-white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.5rem;
    color: var(--primary-dark);
    border: 4px solid var(--primary-light);
    z-index: 2;
    transform: translateY(-50%);
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
}

.step-card:nth-child(odd) .step-number {
    left: -30px;
}

.step-card:nth-child(even) .step-number {
    right: -30px;
}

.step-icon {
    width: 80px;
    height: 80px;
    background: var(--text-white);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--primary-dark);
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.step-card:hover .step-icon {
    transform: scale(1.1) rotate(5deg);
    color: var(--bg-blue);
}

.step-content {
    padding: 2rem;
}

.step-content h3 {
    font-size: 1.75rem;
    margin-bottom: 1rem;
    color: var(--text-white);
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.step-content p {
    color: var(--text-light);
    margin-bottom: 1.5rem;
    line-height: 1.6;
    font-size: 1.1rem;
    opacity: 0.9;
}

.step-link {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--text-white);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    padding: 0.75rem 1.5rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 30px;
    font-size: 1.1rem;
}

.step-link:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.step-link i {
    transition: transform 0.3s ease;
}

.step-link:hover i {
    transform: translateX(4px);
}

@media (max-width: 768px) {
    .steps-timeline {
        padding: 0 1rem;
    }

    .timeline-line {
        left: 30px;
    }

    .step-card {
        width: calc(100% - 60px);
        margin-left: 60px !important;
        padding-left: 2rem !important;
        padding-right: 1rem !important;
    }

    .step-number {
        left: -45px !important;
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
    }

    .step-content {
        padding: 1.5rem;
    }

    .step-content h3 {
        font-size: 1.5rem;
    }

    .step-content p {
        font-size: 1rem;
    }
}

/* CTA Section - New Design */
.cta-section {
    padding: 8rem 0;
    background: white;
    color: var(--gray-800);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.animated-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
}

.wave {
    position: absolute;
    width: 200%;
    height: 200%;
    opacity: 0.3;
}

.wave1 {
    background: radial-gradient(circle at center, transparent 30%, var(--primary-light) 70%);
    animation: rotate 20s linear infinite;
}

.wave2 {
    background: radial-gradient(circle at center, transparent 40%, var(--bg-blue) 80%);
    animation: rotate 15s linear infinite reverse;
}

.wave3 {
    background: radial-gradient(circle at center, transparent 35%, var(--primary-dark) 75%);
    animation: rotate 25s linear infinite;
}

.particles {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(2px 2px at 20px 20px, var(--primary-light) 50%, transparent),
        radial-gradient(2px 2px at 40px 70px, var(--bg-blue) 50%, transparent),
        radial-gradient(2px 2px at 60px 110px, var(--primary-dark) 50%, transparent);
    background-size: 100px 100px;
    animation: twinkle 4s ease-in-out infinite;
}

.cta-section .container {
    position: relative;
    z-index: 2;
}

.cta-section h2 {
    font-size: 3.5rem;
    margin-bottom: 1.5rem;
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--bg-blue) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    position: relative;
    display: inline-block;
}

.glow-text::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 100%;
    transform: translate(-50%, -50%);
    filter: blur(20px);
    background: var(--primary-light);
    opacity: 0.3;
    z-index: -1;
    animation: glow 2s ease-in-out infinite;
}

.cta-section p {
    font-size: 1.25rem;
    margin-bottom: 3rem;
    color: var(--gray-600);
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.cta-buttons {
    display: flex;
    gap: 2rem;
    justify-content: center;
}

.btn {
    position: relative;
    padding: 1rem 2.5rem;
    border-radius: 30px;
    font-size: 1.1rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.3s ease;
    overflow: hidden;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--bg-blue) 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
}

.btn-outline {
    border: 2px solid var(--primary-dark);
    color: var(--primary-dark);
}

.shine-effect::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(
        to right,
        rgba(255, 255, 255, 0) 0%,
        rgba(255, 255, 255, 0.3) 50%,
        rgba(255, 255, 255, 0) 100%
    );
    transform: rotate(45deg);
    animation: shine 3s infinite;
}

.pulse-effect {
    animation: pulse 2s infinite;
}

@keyframes rotate {
    from {
        transform: rotate(0deg) scale(2);
    }
    to {
        transform: rotate(360deg) scale(2);
    }
}

@keyframes shine {
    0% {
        left: -50%;
    }
    100% {
        left: 150%;
    }
}

@keyframes pulse {
    0% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4);
    }
    70% {
        transform: scale(1.05);
        box-shadow: 0 0 0 10px rgba(37, 99, 235, 0);
    }
    100% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(37, 99, 235, 0);
    }
}

@keyframes glow {
    0%, 100% {
        opacity: 0.3;
        transform: translate(-50%, -50%) scale(1);
    }
    50% {
        opacity: 0.5;
        transform: translate(-50%, -50%) scale(1.1);
    }
}

@media (max-width: 768px) {
    .cta-section {
        padding: 4rem 0;
    }

    .cta-section h2 {
        font-size: 2.5rem;
    }

    .cta-buttons {
        flex-direction: column;
        gap: 1rem;
        padding: 0 2rem;
    }

    .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (prefers-reduced-motion: reduce) {
    .wave, .particles, .shine-effect::before, .pulse-effect, .glow-text::after {
        animation: none;
    }
}

/* Statistics Section - New Design */
.statistics {
    padding: 8rem 0;
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, var(--bg-blue) 0%, var(--primary-dark) 100%);
    color: var(--text-white);
}

.stats-bg {
    position: absolute;
    inset: 0;
    overflow: hidden;
}

.moving-gradient {
    position: absolute;
    width: 200%;
    height: 200%;
    top: -50%;
    left: -50%;
    background: radial-gradient(circle at center, rgba(255,255,255,0.1) 0%, transparent 50%);
    animation: rotate 20s linear infinite;
}

.dots-pattern {
    position: absolute;
    inset: 0;
    background-image: 
        radial-gradient(circle at 10px 10px, rgba(255,255,255,0.1) 2px, transparent 0),
        radial-gradient(circle at 30px 30px, rgba(255,255,255,0.1) 2px, transparent 0);
    background-size: 40px 40px;
    animation: float 10s ease-in-out infinite;
}

.statistics .section-title {
    text-align: center;
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 5rem;
    background: linear-gradient(135deg, var(--text-white) 0%, var(--primary-light) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    position: relative;
    z-index: 1;
}

.stats-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 4rem;
    position: relative;
    z-index: 1;
}

.stats-row {
    display: flex;
    justify-content: center;
    gap: 4rem;
}

.stat-item {
    text-align: center;
    flex: 1;
    max-width: 300px;
    perspective: 1000px;
    transform-style: preserve-3d;
}

.stat-circle {
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto 2rem;
    transform: rotateY(25deg) rotateX(10deg);
    transition: transform 0.5s ease;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
}

.stat-item:hover .stat-circle {
    transform: rotateY(0deg) rotateX(0deg);
}

.stat-circle svg {
    width: 100%;
    height: 100%;
    transform: rotate(-90deg);
}

.stat-circle-bg {
    fill: none;
    stroke: rgba(255, 255, 255, 0.2);
    stroke-width: 8;
}

.stat-circle-progress {
    fill: none;
    stroke: var(--text-white);
    stroke-width: 8;
    stroke-dasharray: 283;
    stroke-dashoffset: 283;
    stroke-linecap: round;
    filter: drop-shadow(0 0 15px rgba(255,255,255,0.7));
    transition: stroke-dashoffset 2s ease;
}

.stat-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
    background: rgba(255, 255, 255, 0.1);
    padding: 2rem;
    border-radius: 50%;
    width: 80%;
    height: 80%;
    backdrop-filter: blur(5px);
    box-shadow: inset 0 0 20px rgba(255, 255, 255, 0.2);
}

.stat-icon {
    font-size: 2.5rem;
    color: var(--text-white);
    margin-bottom: 0.5rem;
    filter: drop-shadow(0 0 10px rgba(255,255,255,0.5));
    background: rgba(255, 255, 255, 0.2);
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    color: var(--text-white);
    text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
    line-height: 1;
}

.stat-number .plus,
.stat-number span {
    font-size: 2rem;
    font-weight: 600;
    color: var(--text-white);
    opacity: 0.9;
}

.stat-item h3 {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--text-white);
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.stat-item p {
    color: var(--text-light);
    opacity: 0.9;
    font-size: 1.1rem;
    font-weight: 500;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

@keyframes glowEffect {
    0%, 100% {
        filter: brightness(1) drop-shadow(0 0 10px rgba(255,255,255,0.3));
    }
    50% {
        filter: brightness(1.2) drop-shadow(0 0 15px rgba(255,255,255,0.5));
    }
}

.stat-icon {
    animation: glowEffect 3s infinite ease-in-out;
}

@media (max-width: 1024px) {
    .stat-circle {
        width: 180px;
        height: 180px;
    }

    .stat-icon {
        font-size: 2rem;
        width: 50px;
        height: 50px;
    }

    .stat-number {
        font-size: 2.5rem;
    }

    .stat-number .plus,
    .stat-number span {
        font-size: 1.75rem;
    }
}

@media (max-width: 768px) {
    .stat-circle {
        width: 160px;
        height: 160px;
    }

    .stat-content {
        gap: 0.5rem;
    }

    .stat-icon {
        font-size: 1.75rem;
        width: 45px;
        height: 45px;
    }

    .stat-number {
        font-size: 2.25rem;
    }

    .stat-item h3 {
        font-size: 1.5rem;
    }

    .stat-item p {
        font-size: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statItems = document.querySelectorAll('.stat-item');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const item = entry.target;
                const counter = item.querySelector('.counter');
                const circle = item.querySelector('.stat-circle-progress');
                const targetValue = parseInt(item.dataset.value);
                
                // Anime le compteur
                animateCounter(counter, targetValue);
                
                // Anime le cercle de progression
                const percentage = targetValue > 100 ? 100 : targetValue;
                const dashoffset = 283 - (283 * percentage / 100);
                circle.style.strokeDashoffset = dashoffset;
                
                observer.unobserve(item);
            }
        });
    }, {
        threshold: 0.5
    });
    
    function animateCounter(counter, target) {
        const duration = 2000;
        const startTime = performance.now();
        const startValue = 0;
        
        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // Fonction d'accélération/décélération
            const easeProgress = 1 - Math.pow(1 - progress, 4);
            
            const currentValue = Math.floor(startValue + (target - startValue) * easeProgress);
            counter.textContent = currentValue;
            
            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }
        
        requestAnimationFrame(update);
    }
    
    statItems.forEach(item => observer.observe(item));

    // Animation de la timeline
    const stepsTimeline = document.querySelector('.steps-timeline');
    const progressLine = document.querySelector('.progress-line');
    const stepCards = document.querySelectorAll('.step-card');

    const observerTimeline = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
            progressLine.style.height = '100%';
            stepCards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('animate');
                }, index * 300);
            });
        }
    }, {
        threshold: 0.2
    });

    if (stepsTimeline) {
        observerTimeline.observe(stepsTimeline);
    }

    // Animation des témoignages
    const testimonialCards = document.querySelectorAll('.instagram-post');
    const testimonialTexts = document.querySelectorAll('.post-text');
    
    const observerTestimonials = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const card = entry.target;
                const delay = card.dataset.delay || 0;
                
                setTimeout(() => {
                    card.classList.add('animate');
                    
                    // Anime le texte du témoignage
                    const postText = card.querySelector('.post-text');
                    if (postText) {
                        postText.classList.add('animate');
                        typeWriter(postText);
                    }
                }, delay);
                
                observerTestimonials.unobserve(card);
            }
        });
    }, {
        threshold: 0.2
    });

    testimonialCards.forEach(card => {
        observerTestimonials.observe(card);
    });

    // Effet de machine à écrire pour les témoignages
    function typeWriter(element) {
        const text = element.querySelector('p').textContent;
        element.querySelector('p').textContent = '';
        let i = 0;
        
        function type() {
            if (i < text.length) {
                element.querySelector('p').textContent += text.charAt(i);
                i++;
                setTimeout(type, 20);
            }
        }
        
        type();
    }

    // Gestion des boutons "J'aime"
    const likeButtons = document.querySelectorAll('.like-btn');
    likeButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.toggle('liked');
            const icon = this.querySelector('i');
            icon.classList.toggle('far');
            icon.classList.toggle('fas');
            
            // Animation du compteur de likes
            const statElement = this.closest('.instagram-post').querySelector('.stat i.fa-heart').parentElement;
            const currentLikes = parseInt(statElement.textContent);
            if (this.classList.contains('liked')) {
                statElement.textContent = `${currentLikes + 1}`;
            } else {
                statElement.textContent = `${currentLikes - 1}`;
            }
        });
    });
});
</script>