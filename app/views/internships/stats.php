<div class="dashboard-section">
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- En-tête -->
                <div class="header-section">
                    <h1 class="company-title"><?= $title ?></h1>
                </div>

                <div class="content-grid">
                    <!-- Première rangée de cartes -->
                    <div class="stats-grid">
                        <!-- Statistiques générales -->
                        <div class="info-card">
                            <div class="card-body">
                                <h5 class="section-title">Vue d'ensemble</h5>
                                <div class="stat-item">
                                    <span class="stat-label">Stages</span>
                                    <span class="stat-value"><?= $stats['total_internships'] ?></span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-label">Candidatures</span>
                                    <span class="stat-value"><?= $stats['total_applications'] ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Distribution des statuts -->
                        <div class="info-card">
                            <div class="card-body">
                                <h5 class="section-title">Statuts des candidatures</h5>
                                <?php if (!empty($stats['status_distribution'])): ?>
                                    <?php foreach ($stats['status_distribution'] as $status): ?>
                                        <div class="status-item">
                                            <span><?= ucfirst($status['status']) ?></span>
                                            <span class="badge"><?= $status['count'] ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="no-data">Aucune candidature</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Tableau des stages -->
                    <div class="info-card">
                        <div class="card-body">
                            <h5 class="section-title">
                                <?= isset($_SESSION['user']['company_id']) ? 'Vos stages' : 'Stages populaires' ?>
                            </h5>
                            <div class="table-container">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Stage</th>
                                            <th>Candidatures</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $internships = isset($_SESSION['user']['company_id']) 
                                            ? $stats['internships_details'] 
                                            : $stats['top_internships'];
                                        
                                        if (!empty($internships)):
                                            foreach ($internships as $internship): 
                                        ?>
                                            <tr>
                                                <td><?= htmlspecialchars($internship['title']) ?></td>
                                                <td class="text-center"><?= $internship['applications_count'] ?></td>
                                                <td>
                                                    <a href="/srx/internships/view/<?= $internship['id'] ?>" 
                                                       class="btn-action">
                                                        <i class="fas fa-eye"></i> Détails
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php 
                                            endforeach;
                                        else:
                                        ?>
                                            <tr>
                                                <td colspan="3" class="no-data">Aucun stage disponible</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

<style>
/* Variables */
:root {
    --primary: #2563eb;
    --primary-dark: #1e40af;
    --background: #f8fafc;
    --text-primary: #1e293b;
    --text-secondary: #64748b;
    --border: #e2e8f0;
    --success: #28a745;
}

/* Structure générale */
.dashboard-section {
    background: var(--background);
    min-height: 100vh;
}

.container-fluid {
    max-width: 1400px;
    padding: 2rem;
}

.content-grid {
    display: grid;
    gap: 2rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

/* En-tête */
.header-section {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    padding: 2rem;
    margin: -2rem -2rem 2rem;
    border-radius: 0 0 1rem 1rem;
    color: white;
}

.company-title {
    font-size: 1.75rem;
    margin: 0;
    font-weight: 600;
    text-align: center;
}

/* Cartes */
.info-card {
    background: white;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: 1px solid var(--border);
    transition: transform 0.2s ease;
}

.info-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 1.5rem;
}

.section-title {
    font-size: 1.25rem;
    color: var(--primary-dark);
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--border);
}

/* Statistiques */
.stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid var(--border);
}

.stat-label {
    color: var(--text-secondary);
}

.stat-value {
    font-weight: 600;
    color: var(--primary);
    font-size: 1.2rem;
}

/* Tableau */
.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

.data-table th {
    background: var(--primary);
    color: white;
    padding: 1rem;
    text-align: left;
    font-weight: 500;
}

.data-table td {
    padding: 1rem;
    border-bottom: 1px solid var(--border);
}

.data-table tr:hover {
    background-color: #f8fafc;
}

/* Badge */
.badge {
    background: var(--primary);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 1rem;
    font-size: 0.9rem;
}

/* Boutons */
.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: var(--primary);
    color: white;
    border-radius: 0.5rem;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-action:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* États */
.no-data {
    color: var(--text-secondary);
    text-align: center;
    padding: 1.5rem;
    font-style: italic;
}

/* Responsive */
@media (max-width: 768px) {
    .container-fluid {
        padding: 1rem;
    }
    
    .header-section {
        margin: -1rem -1rem 1.5rem;
        padding: 1.5rem;
    }
    
    .data-table th,
    .data-table td {
        padding: 0.75rem;
    }
    
    .btn-action {
        font-size: 0.9rem;
        padding: 0.4rem 0.8rem;
    }
}
</style>