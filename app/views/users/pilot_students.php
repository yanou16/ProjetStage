<?php if (isset($data)) extract($data); ?>

<section class="hero-section">
    <div class="hero-bg">
        <div class="hero-waves"></div>
    </div>
    <div class="hero-content">
        <div class="container">
            <h1>Mes Étudiants</h1>
            <p>Gérez et suivez vos étudiants</p>
        </div>
    </div>
</section>

<div class="search-container">
    <div class="search-box">
        <div class="header-actions">
            <div class="search-input-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="searchUsers" placeholder="Rechercher un étudiant...">
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="alert alert-<?= $_SESSION['flash_message']['type'] ?>" role="alert">
            <i class="fas fa-info-circle"></i>
            <?= $_SESSION['flash_message']['message'] ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <div class="users-grid">
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <?php if ($user['role_id'] === 3): ?> <!-- Afficher uniquement les étudiants -->
                    <div class="user-card" data-username="<?= htmlspecialchars($user['username']) ?>" data-email="<?= htmlspecialchars($user['email']) ?>">
                        <div class="user-avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                            </svg>
                        </div>
                        <div class="user-info">
                            <div class="user-main-info">
                                <h3 class="user-name"><?= htmlspecialchars($user['username']) ?></h3>
                                <p class="user-email">
                                    <i class="fas fa-envelope"></i>
                                    <?= htmlspecialchars($user['email']) ?>
                                </p>
                                <p class="user-date">
                                    <i class="fas fa-calendar"></i>
                                    <span>Créé le <?= date('d/m/Y', strtotime($user['created_at'])) ?></span>
                                </p>
                            </div>
                            <div class="badge">
                                <i class="fas fa-user-graduate"></i> Étudiant
                            </div>
                        </div>
                        <div class="user-actions">
                            <a href="/srx/internships/studentStats/<?= $user['id'] ?>" class="btn-icon btn-stats" title="Statistiques">
                                <i class="fas fa-chart-bar"></i>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-user-graduate"></i>
                <h3>Aucun étudiant trouvé</h3>
                <p>Vous n'avez pas encore d'étudiants assignés</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .hero-section {
        background: linear-gradient(135deg, #4171d6 0%, #3e64ff 100%);
        padding: 4rem 0;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .hero-waves {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100px;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
        background-size: cover;
        background-position: center;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .search-container {
        background: white;
        padding: 1rem;
        margin-top: -2rem;
        margin-bottom: 2rem;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    .search-box {
        padding: 1rem;
    }

    .header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }

    .search-input-wrapper {
        flex: 1;
        position: relative;
    }

    .search-input-wrapper i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
    }

    #searchUsers {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        font-size: 0.95rem;
    }

    .users-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        padding: 1rem 0;
    }

    .user-card {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        display: flex;
        gap: 1rem;
    }

    .user-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        grid-column: 1 / -1;
    }

    .empty-state i {
        font-size: 3rem;
        color: #64748b;
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #64748b;
    }

    @media (max-width: 768px) {
        .users-grid {
            grid-template-columns: 1fr;
        }

        .header-actions {
            flex-direction: column;
        }

        .search-input-wrapper {
            width: 100%;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchUsers');
    const userCards = document.querySelectorAll('.user-card');

    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();

        userCards.forEach(card => {
            const username = card.dataset.username.toLowerCase();
            const email = card.dataset.email.toLowerCase();

            if (username.includes(searchTerm) || email.includes(searchTerm)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script> 