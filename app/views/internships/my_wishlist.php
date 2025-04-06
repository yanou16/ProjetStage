<div class="container-fluid p-0">
    <div class="wishlist-section">
        <div class="hero-section">
            <div class="hero-content">
                <h1>Mes Stages Favoris</h1>
                <p>Retrouvez tous les stages qui vous intéressent en un seul endroit</p>
            </div>
        </div>
        
        <div class="wishlist-container">
            <?php if (empty($wishlist)): ?>
                <div class="empty-state">
                    <i class="fas fa-heart"></i>
                    <h3>Liste de favoris vide</h3>
                    <p>Vous n'avez pas encore ajouté de stages à vos favoris. Découvrez les opportunités disponibles !</p>
                    <a href="/srx/internships" class="btn-primary">
                        <i class="fas fa-search"></i> Parcourir les stages
                    </a>
                </div>
            <?php else: ?>
                <div class="wishlist-grid">
                    <?php foreach ($wishlist as $item): ?>
                        <div class="wishlist-card">
                            <div class="wishlist-header">
                                <div class="company-info">
                                    <div class="company-logo">
                                        <?= strtoupper(substr($item['company_name'], 0, 2)) ?>
                                    </div>
                                    <div class="company-details">
                                        <h3><?= htmlspecialchars($item['internship_title']) ?></h3>
                                        <p class="company-name">
                                            <i class="fas fa-building"></i>
                                            <?= htmlspecialchars($item['company_name']) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="wishlist-body">
                                <div class="internship-details">
                                    <div class="detail-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span><?= isset($item['location']) ? htmlspecialchars($item['location']) : 'Non spécifié' ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-euro-sign"></i>
                                        <span><?= isset($item['compensation']) ? number_format($item['compensation'], 2) : '0.00' ?>€ / mois</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span><?= isset($item['duration']) ? htmlspecialchars($item['duration']) : '0' ?> semaines</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Ajouté le <?= isset($item['added_date']) ? date('d/m/Y', strtotime($item['added_date'])) : date('d/m/Y') ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="wishlist-footer">
                                <div class="wishlist-actions">
                                    <a href="/srx/internships/view/<?= $item['internship_id'] ?>" 
                                       class="btn-action btn-view">
                                        <i class="fas fa-eye"></i>
                                        Voir le stage
                                    </a>
                                    <form action="/srx/internships/toggleWishlist/<?= $item['internship_id'] ?>" 
                                          method="POST" class="d-inline">
                                        <button type="submit" class="btn-action btn-remove">
                                            <i class="fas fa-heart-broken"></i>
                                            Retirer des favoris
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
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

.wishlist-section {
    padding: 0;
    background: var(--bg-light);
    min-height: calc(100vh - 60px);
    position: relative;
    overflow: hidden;
}

.wishlist-section::before {
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

@keyframes backgroundShift {
    0% {
        background-position: 0% 0%;
    }
    100% {
        background-position: 100% 100%;
    }
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

.hero-content p {
    font-size: 1.2rem;
    opacity: 0;
    animation: fadeIn 1s ease-out 0.5s forwards;
}

.wishlist-container {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: -2rem auto 0;
    padding: 0 2rem;
}

.wishlist-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
    padding: 2rem 0;
    position: relative;
    z-index: 2;
}

.wishlist-card {
    background: var(--bg-white);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.08);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(59, 130, 246, 0.1);
    position: relative;
    z-index: 3;
    opacity: 0;
    transform: translateY(20px);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.wishlist-card::before {
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

.wishlist-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 25px 35px -5px rgba(59, 130, 246, 0.25);
}

.wishlist-card:hover::before {
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

.wishlist-header {
    padding: 2rem;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
    position: relative;
    overflow: hidden;
}

.wishlist-header::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 40%, rgba(255,255,255,0.1) 45%, transparent 50%);
    background-size: 200% 200%;
    animation: headerShine 3s linear infinite;
}

@keyframes headerShine {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
}

.company-info {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.company-logo {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.company-logo::before {
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
    animation: logoShine 3s ease-in-out infinite;
}

@keyframes logoShine {
    0% {
        transform: rotate(45deg) translateY(-100%);
    }
    100% {
        transform: rotate(45deg) translateY(100%);
    }
}

.company-logo i {
    font-size: 2rem;
    color: white;
    position: relative;
    z-index: 1;
}

.company-details {
    flex: 1;
}

.company-details h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 0 0.5rem;
    color: white;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.company-details p {
    margin: 0;
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.9);
}

.company-details a {
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
}

.company-details a:hover {
    opacity: 0.8;
    text-decoration: underline;
}

.wishlist-body {
    padding: 2rem;
    background: var(--bg-white);
}

.internship-details {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem;
    background: rgba(243, 244, 246, 0.5);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.detail-item:hover {
    background: rgba(243, 244, 246, 0.8);
    transform: translateX(5px);
}

.detail-item i {
    color: var(--primary);
    font-size: 1.25rem;
    background: rgba(59, 130, 246, 0.1);
    padding: 0.75rem;
    border-radius: 12px;
}

.wishlist-footer {
    padding: 1.5rem 2rem;
    background: rgba(243, 244, 246, 0.5);
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.wishlist-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    align-items: center;
    flex-wrap: wrap;
}

.btn-action {
    width: auto;
    min-width: 140px;
    height: 42px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: var(--text-primary);
    background: white;
    border: 2px solid rgba(59, 130, 246, 0.2);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    text-decoration: none;
    font-weight: 500;
}

.btn-action::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at center, rgba(59, 130, 246, 0.2), transparent);
    transform: scale(0);
    transition: transform 0.4s ease;
}

.btn-action:hover {
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.3);
}

.btn-action:hover::before {
    transform: scale(2);
    animation: pulseEffect 1s infinite;
}

.btn-view {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
    text-decoration: none;
    font-weight: 600;
    gap: 8px;
    padding: 0 1rem;
    white-space: nowrap;
    font-size: 0.95rem;
}

.btn-view i {
    margin-right: 6px;
}

.btn-remove {
    border-color: var(--danger);
    color: var(--danger);
}

.btn-remove:hover {
    background: var(--danger);
    color: white;
    border-color: var(--danger);
}

.empty-state {
    position: relative;
    z-index: 3;
    text-align: center;
    padding: 6rem 2rem;
    background: var(--bg-white);
    border-radius: 24px;
    border: 2px dashed rgba(59, 130, 246, 0.2);
    max-width: 600px;
    margin: 3rem auto;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    animation: floatAnimation 3s ease-in-out infinite;
}

@keyframes floatAnimation {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
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
    animation: heartbeat 1.5s ease-in-out infinite;
}

@keyframes heartbeat {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
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
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
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
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
}

@media (max-width: 768px) {
    .hero-section {
        padding: 3rem 1.5rem;
    }
    
    .hero-content h1 {
        font-size: 2.5rem;
    }
    
    .wishlist-container {
        padding: 0 1.5rem;
    }
    
    .wishlist-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .company-logo {
        width: 50px;
        height: 50px;
    }
    
    .company-details h3 {
        font-size: 1.25rem;
    }
    
    .btn-primary {
        padding: 1rem 2rem;
        font-size: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.wishlist-card');
    
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
        card.dataset.delay = index * 150;
        observer.observe(card);
    });

    // Effet de parallaxe sur le hero
    const hero = document.querySelector('.hero-section');
    document.addEventListener('mousemove', (e) => {
        const moveX = (e.clientX - window.innerWidth / 2) * 0.005;
        const moveY = (e.clientY - window.innerHeight / 2) * 0.005;
        hero.style.transform = `translate(${moveX}px, ${moveY}px)`;
    });

    // Animation du cœur brisé au survol
    const removeButtons = document.querySelectorAll('.btn-remove');
    removeButtons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            const icon = button.querySelector('i');
            icon.style.animation = 'heartBreak 0.5s ease-in-out';
        });
        button.addEventListener('mouseleave', () => {
            const icon = button.querySelector('i');
            icon.style.animation = '';
        });
    });
});

// Animation du cœur brisé
const style = document.createElement('style');
style.textContent = `
@keyframes heartBreak {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.2) rotate(15deg);
    }
    100% {
        transform: scale(1) rotate(0);
    }
}`;
document.head.appendChild(style);
</script>