<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><?= $title ?></h1>
            </div>

            <?php if (empty($applications)): ?>
                <div class="alert alert-info">
                    Vous n'avez pas encore postulé à des stages.
                    <a href="/srx/internships" class="alert-link">Voir les offres disponibles</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Stage</th>
                                <th>Entreprise</th>
                                <th>Date de candidature</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($applications as $application): ?>
                                <tr>
                                    <td><?= htmlspecialchars($application['internship_title']) ?></td>
                                    <td>
                                        <a href="/srx/companies/view/<?= $application['company_id'] ?>">
                                            <?= htmlspecialchars($application['company_name']) ?>
                                        </a>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($application['created_at'])) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $application['status'] === 'accepted' ? 'success' : 
                                            ($application['status'] === 'rejected' ? 'danger' : 'warning') ?>">
                                            <?= ucfirst($application['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/srx/internships/view/<?= $application['internship_id'] ?>" 
                                           class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> Voir le stage
                                        </a>
                                        <?php if ($application['cv_path']): ?>
                                            <a href="/srx/<?= $application['cv_path'] ?>" 
                                               class="btn btn-sm btn-secondary" target="_blank">
                                                <i class="bi bi-file-pdf"></i> Voir CV
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>