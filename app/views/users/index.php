<?php
// Extraction des variables
if (isset($data)) {
    extract($data);
}
?>

<!-- Header Section -->
<div class="page-header">
    <div class="container">
        <div class="header-content">
            <h1>Gestion des utilisateurs</h1>
            <p class="text-muted">Gérez les comptes utilisateurs de la plateforme</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchUsers" placeholder="Rechercher un utilisateur...">
            </div>
            <a href="/srx/users/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nouveau compte
            </a>
        </div>
    </div>
</div>

<!-- Main Content -->
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
                <div class="user-card" data-username="<?= htmlspecialchars($user['username']) ?>" data-email="<?= htmlspecialchars($user['email']) ?>">
                    <div class="user-card-header">
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="user-status">
                            <?php
                            switch ($user['role_id']) {
                                case 1:
                                    echo '<span class="badge badge-admin">Admin</span>';
                                    break;
                                case 2:
                                    echo '<span class="badge badge-pilot">Pilote</span>';
                                    break;
                                case 3:
                                    echo '<span class="badge badge-student">Étudiant</span>';
                                    break;
                                default:
                                    echo '<span class="badge badge-unknown">Inconnu</span>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="user-card-body">
                        <h3 class="user-name"><?= htmlspecialchars($user['username']) ?></h3>
                        <p class="user-email"><?= htmlspecialchars($user['email']) ?></p>
                        <p class="user-date">
                            <i class="fas fa-calendar"></i>
                            Créé le <?= date('d/m/Y', strtotime($user['created_at'])) ?>
                        </p>
                    </div>
                    <div class="user-card-actions">
                        <a href="/srx/users/edit/<?= $user['id'] ?>" class="btn btn-icon btn-edit" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-icon btn-delete" title="Supprimer" 
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

<style>
/* Page Header */
.page-header {
    background: white;
    padding: 2rem 0;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.header-content {
    margin-bottom: 1.5rem;
}

.header-content h1 {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.header-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
}

/* Search Box */
.search-box {
    position: relative;
    flex: 1;
    max-width: 400px;
}

.search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray);
}

.search-box input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 1px solid #e2e8f0;
    border-radius: 50px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.search-box input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

/* Users Grid */
.users-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

/* User Card */
.user-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.user-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.user-card-header {
    padding: 1.5rem;
    background: linear-gradient(45deg, var(--primary), var(--secondary));
    color: white;
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.user-avatar {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.user-card-body {
    padding: 1.5rem;
}

.user-name {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
}

.user-email {
    color: var(--gray);
    margin-bottom: 1rem;
}

.user-date {
    font-size: 0.9rem;
    color: var(--gray);
}

.user-date i {
    margin-right: 0.5rem;
}

.user-card-actions {
    padding: 1rem 1.5rem;
    background: #f8fafc;
    display: flex;
    gap: 0.5rem;
    justify-content: flex-end;
}

/* Badges */
.badge {
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 500;
}

.badge-admin {
    background: #ef4444;
    color: white;
}

.badge-pilot {
    background: #3b82f6;
    color: white;
}

.badge-student {
    background: #10b981;
    color: white;
}

.badge-unknown {
    background: #6b7280;
    color: white;
}

/* Buttons */
.btn-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-edit {
    background: #dbeafe;
    color: #2563eb;
}

.btn-edit:hover {
    background: #2563eb;
    color: white;
}

.btn-delete {
    background: #fee2e2;
    color: #ef4444;
}

.btn-delete:hover {
    background: #ef4444;
    color: white;
}

/* Empty State */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 15px;
}

.empty-state i {
    font-size: 4rem;
    color: var(--gray);
    margin-bottom: 1.5rem;
}

.empty-state h3 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: var(--gray);
    margin-bottom: 1.5rem;
}

/* Alert */
.alert {
    border-radius: 12px;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.alert i {
    font-size: 1.25rem;
}
</style>

<script>
// Recherche en temps réel
document.getElementById('searchUsers').addEventListener('input', function(e) {
    const searchValue = e.target.value.toLowerCase();
    const userCards = document.querySelectorAll('.user-card');
    
    userCards.forEach(card => {
        const username = card.dataset.username.toLowerCase();
        const email = card.dataset.email.toLowerCase();
        
        if (username.includes(searchValue) || email.includes(searchValue)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

// Confirmation de suppression
function confirmDelete(userId, username) {
    if (confirm(`Êtes-vous sûr de vouloir supprimer l'utilisateur "${username}" ?`)) {
        window.location.href = '/srx/users/delete/' + userId;
    }
}
</script>