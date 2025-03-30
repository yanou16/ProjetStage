<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><?= $title ?></h1>
            </div>

            <div class="wishlist-section">
                <?php if (empty($wishlist)): ?>
                    <div class="empty-state">
                        <i class="fas fa-heart"></i>
                        <h3>Liste de favoris vide</h3>
                        <p>Vous n'avez pas encore ajouté de stages à vos favoris.</p>
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
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <div class="company-details">
                                            <h3><?= htmlspecialchars($item['internship_title']) ?></h3>
                                            <p>
                                                <a href="/srx/companies/view/<?= $item['company_id'] ?>" class="text-white">
                                                    <?= htmlspecialchars($item['company_name']) ?>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="wishlist-body">
                                    <div class="wishlist-details">
                                        <div class="detail-item">
                                            <i class="fas fa-calendar"></i>
                                            <span>Ajouté le <?= date('d/m/Y', strtotime($item['created_at'])) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="wishlist-footer">
                                    <div class="wishlist-actions">
                                        <a href="/srx/internships/view/<?= $item['internship_id'] ?>" 
                                           class="btn-icon btn-view" title="Voir le stage">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="/srx/internships/toggleWishlist/<?= $item['internship_id'] ?>" 
                                              method="POST" class="d-inline">
                                            <button type="submit" class="btn-icon btn-remove" title="Retirer des favoris">
                                                <i class="fas fa-heart-broken"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>

<style>
/* Wishlist Section */
.wishlist-section {
    padding: 2rem;
    background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
    min-height: calc(100vh - 60px);
}

.wishlist-header {
    margin-bottom: 2rem;
    background: linear-gradient(135deg, #3B82F6 0%, #60A5FA 100%);
    padding: 2rem;
    border-radius: 15px;
    color: white;
}

.wishlist-title {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    color: white;
}

/* Wishlist Grid */
.wishlist-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
}

.wishlist-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    border: 1px solid #E2E8F0;
}

.wishlist-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.wishlist-header {
    padding: 1.5rem;
    background: linear-gradient(135deg, #3B82F6 0%, #60A5FA 100%);
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.company-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.company-logo {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.company-logo i {
    font-size: 1.5rem;
    color: white;
}

.company-details h3 {
    margin: 0;
    font-size: 1.2rem;
    font-weight: 600;
    color: white;
}

.company-details p {
    margin: 0;
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
}

.wishlist-body {
    padding: 1.5rem;
    flex: 1;
    background: white;
}

.wishlist-details {
    display: grid;
    gap: 1rem;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #1E3A8A;
}

.detail-item i {
    color: #3B82F6;
    font-size: 1.1rem;
}

.wishlist-footer {
    padding: 1rem 1.5rem;
    background: #F8FAFC;
    border-top: 1px solid #E2E8F0;
    display: flex;
    justify-content: flex-end;
}

.wishlist-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-icon {
    width: 35px;
    height: 35px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1E3A8A;
    background: white;
    border: 1px solid #E2E8F0;
    transition: all 0.3s ease;
    text-decoration: none;
    cursor: pointer;
}

.btn-icon:hover {
    transform: translateY(-2px);
    color: white;
}

.btn-view:hover {
    background: #3B82F6;
    border-color: #3B82F6;
}

.btn-remove:hover {
    background: #EF4444;
    border-color: #EF4444;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.empty-state i {
    font-size: 3rem;
    color: #3B82F6;
    margin-bottom: 1rem;
}

.empty-state h3 {
    color: #1E3A8A;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: #3B82F6;
    margin-bottom: 1.5rem;
}

.btn-primary {
    background: #3B82F6;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #2563EB;
    transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .wishlist-section {
        padding: 1rem;
    }

    .wishlist-grid {
        grid-template-columns: 1fr;
    }

    .wishlist-card {
        margin-bottom: 1rem;
    }
}
</style>