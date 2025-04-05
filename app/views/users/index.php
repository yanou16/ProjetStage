<?php
// Extraction des variables
if (isset($data)) {
    extract($data);
}
?>

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
    --danger-red: #EF4444;
    --gray-100: #F3F4F6;
    --gray-200: #E5E7EB;
    --gray-300: #D1D5DB;
    --gray-600: #4B5563;
    --gray-800: #1F2937;
    --admin-gradient: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
    --pilot-gradient: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    --student-gradient: linear-gradient(135deg, #10B981 0%, #059669 100%);
}

/* Hero Section */
.hero-section {
    position: relative;
    background: linear-gradient(135deg, var(--bg-blue) 0%, var(--primary-dark) 100%);
    padding: 6rem 0 8rem;
    color: var(--text-white);
    text-align: center;
    overflow: hidden;
}

.hero-bg {
    position: absolute;
    inset: 0;
    overflow: hidden;
}

.hero-waves {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100px;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') repeat-x bottom;
    background-size: 100% 100%;
}

.hero-content {
    position: relative;
    z-index: 1;
}

.hero-section h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.hero-section p {
    font-size: 1.25rem;
    max-width: 600px;
    margin: 0 auto;
    opacity: 0.9;
}

/* Search Section */
.search-container {
    max-width: 800px;
    margin: -3rem auto 4rem;
    padding: 0 2rem;
    position: relative;
    z-index: 2;
}

.search-box {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

.search-input-wrapper {
    flex-grow: 1;
    position: relative;
}

.search-input-wrapper i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-600);
    font-size: 1.2rem;
}

#searchUsers {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid var(--gray-200);
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

#searchUsers:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.1);
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-blue), var(--bg-blue));
    color: white;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
}

/* Users List */
.users-grid {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.user-card {
    background: rgba(255, 255, 255, 0.98);
    border-radius: 16px;
    margin-bottom: 1rem;
    overflow: hidden;
    box-shadow: 
        0 4px 15px rgba(0, 0, 0, 0.05),
        0 1px 2px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.8);
    transition: all 0.3s ease;
    opacity: 0;
    transform: translateX(-20px);
    animation: slideInLeft 0.5s forwards;
    display: flex;
    align-items: center;
    padding: 1.5rem;
    gap: 2rem;
}

.user-card:hover {
    transform: translateX(0) scale(1.01);
    box-shadow: 
        0 10px 30px rgba(0, 0, 0, 0.08),
        0 2px 4px rgba(0, 0, 0, 0.05);
    background: linear-gradient(
        90deg,
        rgba(255, 255, 255, 0.98) 0%,
        rgba(249, 250, 251, 0.98) 100%
    );
}

.user-avatar {
    width: 60px;
    height: 60px;
    min-width: 60px;
    background: var(--bg-blue);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    transition: all 0.3s ease;
}

.user-card[data-role="1"] .user-avatar { background: var(--admin-gradient); }
.user-card[data-role="2"] .user-avatar { background: var(--pilot-gradient); }
.user-card[data-role="3"] .user-avatar { background: var(--student-gradient); }

.user-avatar svg {
    width: 24px;
    height: 24px;
    color: white;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.user-info {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 2rem;
}

.user-main-info {
    flex: 1;
}

.user-name {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-email {
    color: var(--gray-600);
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.user-email i {
    color: var(--primary-blue);
    font-size: 1rem;
}

.user-date {
    color: var(--gray-600);
    font-size: 0.9rem;
    min-width: 150px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.user-date i {
    color: var(--primary-blue);
}

.badge {
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--text-white);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.user-card[data-role="1"] .badge { background: var(--admin-gradient); }
.user-card[data-role="2"] .badge { background: var(--pilot-gradient); }
.user-card[data-role="3"] .badge { background: var(--student-gradient); }

.user-actions {
    display: flex;
    gap: 0.75rem;
    margin-left: 1rem;
}

.btn-icon {
    width: 38px;
    height: 38px;
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
    inset: 0;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transform: translateX(-100%);
    transition: transform 0.3s ease;
}

.btn-icon:hover::before {
    transform: translateX(100%);
}

.btn-icon:hover {
    transform: translateY(-2px);
}

.btn-edit {
    background: linear-gradient(135deg, var(--warning-yellow), #F97316);
}

.btn-delete {
    background: linear-gradient(135deg, var(--danger-red), #DC2626);
}

.empty-state {
    text-align: center;
    padding: 6rem 2rem;
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    grid-column: 1 / -1;
}

.empty-state i {
    font-size: 4rem;
    color: var(--gray-300);
    margin-bottom: 1.5rem;
}

.empty-state h3 {
    font-size: 1.5rem;
    color: var(--gray-800);
    margin-bottom: 1rem;
}

.empty-state p {
    color: var(--gray-600);
    margin-bottom: 2rem;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@media (max-width: 1024px) {
    .hero-section h1 {
        font-size: 3rem;
    }
}

@media (max-width: 768px) {
    .hero-section {
        padding: 4rem 0 6rem;
    }
    
    .hero-section h1 {
        font-size: 2.5rem;
    }
    
    .search-container {
        padding: 0 1rem;
    }
    
    .header-actions {
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn-primary {
        width: 100%;
        justify-content: center;
    }
    
    .user-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem;
    }

    .user-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
        width: 100%;
    }

    .user-actions {
        margin-left: 0;
        width: 100%;
        justify-content: flex-end;
    }
}

@media (prefers-reduced-motion: reduce) {
    .user-card {
        animation: none;
        opacity: 1;
        transform: none;
    }
    
    .user-card:hover {
        transform: none;
    }
}
</style>

<section class="hero-section">
    <div class="hero-bg">
        <div class="hero-waves"></div>
    </div>
    <div class="hero-content">
        <div class="container">
            <h1>Gestion des Utilisateurs</h1>
            <p>Gérez les comptes et les accès de votre plateforme en toute simplicité</p>
        </div>
    </div>
</section>

<div class="search-container">
    <div class="search-box">
        <div class="header-actions">
            <div class="search-input-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="searchUsers" placeholder="Rechercher par nom, email ou rôle...">
            </div>
            <a href="/srx/users/create" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Nouveau compte
            </a>
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
                <div class="user-card" data-role="<?= $user['role_id'] ?>" data-username="<?= htmlspecialchars($user['username']) ?>" data-email="<?= htmlspecialchars($user['email']) ?>">
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
                            <?php
                            switch ($user['role_id']) {
                                case 1:
                                    echo '<i class="fas fa-shield-alt"></i> Admin';
                                    break;
                                case 2:
                                    echo '<i class="fas fa-user-tie"></i> Pilote';
                                    break;
                                case 3:
                                    echo '<i class="fas fa-user-graduate"></i> Étudiant';
                                    break;
                                default:
                                    echo '<i class="fas fa-user"></i> Inconnu';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="user-actions">
                        <a href="/srx/users/edit/<?= $user['id'] ?>" class="btn-icon btn-edit" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn-icon btn-delete" title="Supprimer" 
                                onclick="confirmDelete(<?= $user['id'] ?>, '<?= htmlspecialchars($user['username']) ?>')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h3>Aucun utilisateur trouvé</h3>
                <p>Commencez par créer un nouveau compte utilisateur</p>
                <a href="/srx/users/create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Créer un compte
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes au scroll
    const cards = document.querySelectorAll('.user-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'slideInLeft 0.5s forwards';
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });

    cards.forEach(card => {
        observer.observe(card);
    });

    // Fonction de recherche
    document.getElementById('searchUsers').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('.user-card');
        
        cards.forEach(card => {
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

function confirmDelete(id, username) {
    if (confirm(`Êtes-vous sûr de vouloir supprimer le compte de ${username} ?`)) {
        fetch(`/srx/users/delete/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const card = document.querySelector(`[data-user-id="${id}"]`);
                card.style.animation = 'fadeOut 0.3s forwards';
                setTimeout(() => card.remove(), 300);
                location.reload();
            } else {
                alert('Une erreur est survenue lors de la suppression.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de la suppression.');
        });
    }
}
</script>