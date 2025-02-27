<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Statistiques des entreprises</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="/srx/companies" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- Statistiques générales -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Vue d'ensemble</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded">
                                        <h6 class="mb-0">Total des entreprises</h6>
                                        <h2 class="mt-2 mb-0 text-primary"><?= $totalCompanies ?></h2>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded">
                                        <h6 class="mb-0">Total des stages</h6>
                                        <h2 class="mt-2 mb-0 text-primary"><?= $totalInternships ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Répartition par secteur -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Répartition par secteur</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Secteur</th>
                                            <th>Nombre d'entreprises</th>
                                            <th>Pourcentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($sectorStats as $sector): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($sector['industry']) ?></td>
                                            <td><?= $sector['count'] ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" 
                                                         style="width: <?= $sector['percentage'] ?>%"
                                                         aria-valuenow="<?= $sector['percentage'] ?>" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="100">
                                                        <?= number_format($sector['percentage'], 1) ?>%
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top entreprises par nombre de stages -->
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Top entreprises par nombre de stages</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Entreprise</th>
                                            <th>Secteur</th>
                                            <th>Nombre de stages</th>
                                            <th>Dernière offre</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($topCompanies as $company): ?>
                                        <tr>
                                            <td>
                                                <a href="/srx/companies/view/<?= $company['id'] ?>">
                                                    <?= htmlspecialchars($company['name']) ?>
                                                </a>
                                            </td>
                                            <td><?= htmlspecialchars($company['industry']) ?></td>
                                            <td>
                                                <span class="badge bg-primary"><?= $company['internship_count'] ?></span>
                                            </td>
                                            <td><?= $company['last_internship_date'] ? date('d/m/Y', strtotime($company['last_internship_date'])) : '-' ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
.progress {
    height: 20px;
    background-color: #e9ecef;
    border-radius: 10px;
}

.progress-bar {
    background-color: var(--primary);
    color: white;
    text-align: center;
    line-height: 20px;
    border-radius: 10px;
}

.bg-light {
    background-color: #f8fafc !important;
    border-radius: 8px;
}

.badge {
    font-size: 0.9rem;
    padding: 0.5em 1em;
}
</style>