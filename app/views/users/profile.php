<?php
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: /srx/users/login');
    exit;
}

$user = $_SESSION['user'];
?>

<div class="profile-container">
    <div class="profile-header">
        <div class="profile-cover"></div>
        <div class="profile-avatar">
            <i class="fas fa-user"></i>
        </div>
        <h1 class="profile-name"><?= htmlspecialchars($user['name'] ?? $user['email']) ?></h1>
        <p class="profile-role"><?= ucfirst($user['role']) ?></p>
    </div>

    <div class="profile-content">
        <div class="profile-section">
            <h2><i class="fas fa-info-circle"></i> Informations personnelles</h2>
            <div class="info-grid">
                <div class="info-item">
                    <label>Nom complet</label>
                    <p><?= htmlspecialchars($user['name'] ?? 'Non renseigné') ?></p>
                </div>
                <div class="info-item">
                    <label>Email</label>
                    <p><?= htmlspecialchars($user['email']) ?></p>
                </div>
                <div class="info-item">
                    <label>Rôle</label>
                    <p><?= ucfirst($user['role']) ?></p>
                </div>
                <div class="info-item">
                    <label>Date d'inscription</label>
                    <p><?= isset($user['created_at']) ? date('d/m/Y', strtotime($user['created_at'])) : 'Non disponible' ?></p>
                </div>
            </div>
        </div>

        <?php if ($user['role'] === 'student'): ?>
        <div class="profile-section">
            <h2><i class="fas fa-graduation-cap"></i> Informations académiques</h2>
            <div class="info-grid">
                <div class="info-item">
                    <label>Formation</label>
                    <p><?= htmlspecialchars($user['formation'] ?? 'Non renseigné') ?></p>
                </div>
                <div class="info-item">
                    <label>Année d'études</label>
                    <p><?= htmlspecialchars($user['study_year'] ?? 'Non renseigné') ?></p>
                </div>
            </div>
        </div>

        <div class="profile-section">
            <h2><i class="fas fa-chart-line"></i> Statistiques</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-file-alt"></i>
                    <span class="stat-number"><?= $user['applications_count'] ?? 0 ?></span>
                    <span class="stat-label">Candidatures</span>
                </div>
                <div class="stat-card">
                    <i class="fas fa-star"></i>
                    <span class="stat-number"><?= $user['wishlist_count'] ?? 0 ?></span>
                    <span class="stat-label">Favoris</span>
                </div>
                <div class="stat-card">
                    <i class="fas fa-check-circle"></i>
                    <span class="stat-number"><?= $user['accepted_applications'] ?? 0 ?></span>
                    <span class="stat-label">Acceptées</span>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
.profile-container {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.profile-header {
    position: relative;
    text-align: center;
    padding-bottom: 2rem;
    margin-bottom: 2rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.profile-cover {
    height: 200px;
    background: linear-gradient(135deg, #4171d6 0%, #3e64ff 100%);
    border-radius: 20px;
    margin-bottom: 100px;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    background: white;
    border-radius: 50%;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: #4171d6;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 4px solid white;
    overflow: hidden;
}

.profile-name {
    font-size: 2rem;
    color: var(--dark);
    margin: 0;
}

.profile-role {
    color: var(--gray);
    font-size: 1.1rem;
    margin: 0.5rem 0 0;
}

.profile-section {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.profile-section h2 {
    font-size: 1.5rem;
    color: var(--dark);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.8rem;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.info-item label {
    font-size: 0.9rem;
    color: var(--gray);
    margin-bottom: 0.5rem;
    display: block;
}

.info-item p {
    font-size: 1.1rem;
    color: var(--dark);
    margin: 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1.5rem;
}

.stat-card {
    background: rgba(255, 255, 255, 0.5);
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 16px;
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.stat-card i {
    font-size: 2rem;
    color: var(--primary);
    margin-bottom: 1rem;
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 0.5rem;
}

.stat-label {
    color: var(--gray);
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .profile-container {
        margin: 1rem auto;
    }

    .profile-cover {
        height: 150px;
        margin-bottom: 80px;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        font-size: 2rem;
        bottom: 100px;
    }

    .profile-name {
        font-size: 1.5rem;
    }

    .profile-section {
        padding: 1.5rem;
    }

    .info-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}
</style> 