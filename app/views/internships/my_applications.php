<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><?= $title ?></h1>
            </div>

            <div class="applications-section">
                <div class="applications-grid">
                    <?php if (empty($applications)): ?>
                        <div class="empty-state">
                            <i class="fas fa-file-alt"></i>
                            <h3>Aucune candidature</h3>
                            <p>Vous n'avez pas encore postulé à des stages.</p>
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
                                        <a href="/srx/companies/view/<?= $application['company_id'] ?>" class="text-muted">
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
        </main>
    </div>
</div>

<style>
.applications-section {
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: calc(100vh - 60px);
}

.applications-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1.5rem;
}

.application-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid #dee2e6;
}

.application-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.application-header {
    padding: 1.5rem;
    background: linear-gradient(135deg, #3B82F6 0%, #60A5FA 100%);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.company-logo {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.company-logo img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}

.status-badge.pending {
    background: #FEF3C7;
    color: #92400E;
}

.status-badge.accepted {
    background: #DCFCE7;
    color: #166534;
}

.status-badge.rejected {
    background: #FEE2E2;
    color: #991B1B;
}

.application-content {
    padding: 1.5rem;
}

.application-content h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #1e293b;
}

.company-info, .application-date {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    color: #64748b;
}

.company-info i, .application-date i {
    color: #3B82F6;
    font-size: 1rem;
}

.application-actions {
    display: flex;
    gap: 0.75rem;
    margin-top: 1.5rem;
}

.btn-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1e293b;
    background: white;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.btn-icon:hover {
    transform: translateY(-2px);
}

.btn-view:hover {
    background: #3B82F6;
    color: white;
    border-color: #3B82F6;
}

.btn-cv:hover {
    background: #ef4444;
    color: white;
    border-color: #ef4444;
}

.btn-rate {
    flex: 1;
    padding: 0.5rem;
    background: #3B82F6;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-rate:hover {
    background: #2563eb;
    transform: translateY(-2px);
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 12px;
    border: 2px dashed #e2e8f0;
}

.empty-state i {
    font-size: 3rem;
    color: #94a3b8;
    margin-bottom: 1.5rem;
}

.empty-state h3 {
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: #64748b;
    margin-bottom: 1.5rem;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: #3B82F6;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #2563eb;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .applications-section {
        padding: 1rem;
    }
    
    .applications-grid {
        grid-template-columns: 1fr;
    }
}
</style>