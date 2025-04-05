<div class="container-fluid p-0">
    <div class="applications-section">
        <div class="hero-section">
            <div class="hero-content">
                <h1>Mes Candidatures</h1>
                <p>Suivez l'état de vos candidatures et restez informé de leur progression</p>
            </div>
        </div>
        
        <div class="applications-container">
            <div class="applications-grid">
                <?php if (empty($applications)): ?>
                    <div class="empty-state">
                        <i class="fas fa-file-alt"></i>
                        <h3>Aucune candidature</h3>
                        <p>Vous n'avez pas encore postulé à des stages. Découvrez les opportunités disponibles !</p>
                        <a href="/srx/internships" class="btn-primary">
                            <i class="fas fa-search"></i> Découvrir les stages
                        </a>
                    </div>
                <?php else: ?>
                    <?php foreach ($applications as $application): ?>
                        <div class="application-card">
                            <div class="application-header">
                                <span class="status-badge <?= $application['status'] ?>">
                                    <?= ucfirst($application['status']) ?>
                                </span>
                            </div>
                            <div class="application-content">
                                <h3><?= htmlspecialchars($application['internship_title']) ?></h3>
                                <div class="company-info">
                                    <i class="fas fa-building"></i>
                                    <a href="/srx/companies/view/<?= $application['company_id'] ?>">
                                        <?= htmlspecialchars($application['company_name']) ?>
                                    </a>
                                </div>
                                <div class="application-date">
                                    <i class="fas fa-calendar"></i>
                                    <span>Postulé le <?= date('d/m/Y', strtotime($application['created_at'])) ?></span>
                                </div>
                                <div class="application-actions">
                                    <a href="/srx/internships/view/<?= $application['internship_id'] ?>" 
                                       class="btn-icon btn-view" title="Voir le stage">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <?php if ($application['cv_path']): ?>
                                        <a href="/srx/<?= $application['cv_path'] ?>" 
                                           class="btn-icon btn-cv" title="Voir le CV" target="_blank">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($application['status'] === 'accepted'): ?>
                                        <button class="btn-rate" 
                                                onclick="window.location.href='/srx/internships/evaluate/<?= $application['internship_id'] ?>'">
                                            <i class="fas fa-star"></i> Évaluer
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary: #3B82F6;
    --primary-dark: #1D4ED8;
    --primary-light: #60A5FA;
    --success: #10B981;
    --warning: #F59E0B;
    --danger: #EF4444;
    --text-primary: #1F2937;
    --text-secondary: #6B7280;
    --bg-light: #F0F9FF;
    --bg-white: #FFFFFF;
}

.applications-section {
    padding: 0;
    background: var(--bg-light);
    min-height: calc(100vh - 60px);
    position: relative;
}

.applications-section::before {
    content: '';
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: 
        radial-gradient(circle at 0% 0%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 100% 0%, rgba(96, 165, 250, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 100% 100%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 0% 100%, rgba(96, 165, 250, 0.15) 0%, transparent 50%);
    animation: backgroundShift 15s ease-in-out infinite alternate;
    z-index: 0;
    pointer-events: none;
}

.hero-section {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    padding: 4rem 2rem;
    position: relative;
    overflow: hidden;
    margin-bottom: 3rem;
    clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
    z-index: 1;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        linear-gradient(45deg, transparent 45%, rgba(255,255,255,0.1) 50%, transparent 55%),
        linear-gradient(-45deg, transparent 45%, rgba(255,255,255,0.1) 50%, transparent 55%);
    background-size: 30px 30px;
    animation: heroPattern 3s linear infinite;
}

@keyframes heroPattern {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 60px 60px;
    }
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
    color: white;
}

.hero-content h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    background: linear-gradient(to right, #fff, rgba(255,255,255,0.8));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -0.025em;
    animation: titleReveal 1s ease-out forwards;
}

@keyframes titleReveal {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero-content p {
    animation: fadeIn 1s ease-out 0.5s forwards;
    opacity: 0;
}

@keyframes fadeIn {
    to {
        opacity: 1;
    }
}

.applications-container {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: -2rem auto 0;
    padding: 0 2rem;
    background: transparent;
}

.applications-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
    padding: 2rem 0;
    position: relative;
    z-index: 2;
}

.application-card {
    background: var(--bg-white);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.08);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(59, 130, 246, 0.1);
    position: relative;
    z-index: 3;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.application-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent 0%, 
        rgba(59, 130, 246, 0.1) 15%, 
        rgba(59, 130, 246, 0.1) 85%, 
        transparent 100%
    );
    opacity: 0;
    transition: opacity 0.5s ease;
}

.application-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 25px 35px -5px rgba(59, 130, 246, 0.25);
}

.application-card:hover::before {
    opacity: 1;
    animation: cardShine 2s ease-in-out infinite;
}

@keyframes cardShine {
    0% {
        transform: translateX(-100%);
    }
    50%, 100% {
        transform: translateX(100%);
    }
}

.application-header {
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.9);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
}

.status-badge {
    padding: 0.75rem 1.5rem;
    border-radius: 100px;
    font-size: 0.875rem;
    font-weight: 600;
    letter-spacing: 0.025em;
    text-transform: uppercase;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.status-badge::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(
        transparent,
        rgba(255, 255, 255, 0.3),
        transparent
    );
    transform: rotate(45deg);
    animation: badgeShine 3s ease-in-out infinite;
}

@keyframes badgeShine {
    0% {
        transform: rotate(45deg) translateY(-100%);
    }
    100% {
        transform: rotate(45deg) translateY(100%);
    }
}

.status-badge.pending {
    background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
    color: #92400E;
}

.status-badge.accepted {
    background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
    color: #065F46;
}

.status-badge.rejected {
    background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
    color: #991B1B;
}

.application-content {
    padding: 1.5rem;
    background: var(--bg-white);
    position: relative;
}

.application-content h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: var(--text-primary);
    line-height: 1.4;
    letter-spacing: -0.01em;
}

.company-info, .application-date {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.25rem;
    color: var(--text-secondary);
    font-size: 1rem;
    padding: 0.75rem;
    border-radius: 12px;
    background: rgba(243, 244, 246, 0.5);
}

.company-info i, .application-date i {
    color: var(--primary);
    font-size: 1.25rem;
    background: rgba(79, 70, 229, 0.1);
    padding: 0.5rem;
    border-radius: 50%;
}

.company-info a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}

.company-info a:hover {
    color: var(--primary);
    transform: translateX(3px);
}

.application-actions {
    display: flex;
    gap: 1.25rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.btn-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-primary);
    background: white;
    border: 2px solid rgba(59, 130, 246, 0.2);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.btn-icon:hover {
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.3);
}

.btn-icon::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at center, rgba(59, 130, 246, 0.2), transparent);
    transform: scale(0);
    transition: transform 0.4s ease;
}

.btn-icon:hover::before {
    transform: scale(2);
    animation: pulseEffect 1s infinite;
}

@keyframes pulseEffect {
    0% {
        transform: scale(1);
        opacity: 0.5;
    }
    100% {
        transform: scale(2);
        opacity: 0;
    }
}

.btn-view:hover {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
    transform: translateY(-3px) rotate(8deg);
}

.btn-cv:hover {
    background: var(--danger);
    color: white;
    border-color: var(--danger);
    transform: translateY(-3px) rotate(-8deg);
}

.btn-rate {
    flex: 1;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
    border: none;
    border-radius: 100px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
    position: relative;
    overflow: hidden;
}

.btn-rate:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
}

.btn-rate::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(
        transparent,
        rgba(255, 255, 255, 0.3),
        transparent
    );
    transform: rotate(45deg);
    transition: 0.5s;
    animation: buttonShine 2s ease-in-out infinite;
}

@keyframes buttonShine {
    0% {
        transform: rotate(45deg) translateX(-100%);
    }
    100% {
        transform: rotate(45deg) translateX(100%);
    }
}

.empty-state {
    position: relative;
    z-index: 3;
    text-align: center;
    padding: 4rem 2rem;
    background: var(--bg-white);
    border-radius: 20px;
    border: 2px dashed rgba(59, 130, 246, 0.2);
    max-width: 500px;
    margin: 3rem auto;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
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

.empty-state i {
    font-size: 5rem;
    color: var(--primary);
    margin-bottom: 2rem;
    opacity: 0.8;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.empty-state h3 {
    color: var(--text-primary);
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    letter-spacing: -0.025em;
}

.empty-state p {
    color: var(--text-secondary);
    margin-bottom: 2.5rem;
    font-size: 1.25rem;
    line-height: 1.6;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.25rem 2.5rem;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
    border-radius: 100px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.4s ease;
    border: none;
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.2);
    position: relative;
    overflow: hidden;
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 100%);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.btn-primary:hover::before {
    transform: translateX(100%);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
}

@media (max-width: 768px) {
    .hero-section {
        padding: 3rem 1.5rem;
        clip-path: ellipse(150% 100% at 50% 0%);
    }
    
    .hero-content h1 {
        font-size: 2.5rem;
    }
    
    .hero-content p {
        font-size: 1.1rem;
    }
    
    .applications-container {
        padding: 0 1.5rem;
        margin-top: -1.5rem;
    }
    
    .applications-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .application-card {
        margin: 0;
    }

    .btn-primary {
        padding: 1rem 2rem;
        font-size: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.application-card');
    
    function showCard(card, delay) {
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, delay);
    }
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                showCard(entry.target, entry.target.dataset.delay);
            }
        });
    }, {
        threshold: 0.1
    });

    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
        card.dataset.delay = index * 100;
        observer.observe(card);
    });

    // Effet de parallaxe plus subtil
    const hero = document.querySelector('.hero-section');
    document.addEventListener('mousemove', (e) => {
        const moveX = (e.clientX - window.innerWidth / 2) * 0.005;
        const moveY = (e.clientY - window.innerHeight / 2) * 0.005;
        hero.style.transform = `translate(${moveX}px, ${moveY}px)`;
    });
});
</script>