<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><?= $title ?></h1>
            </div>

            <div class="row">
                <!-- Statistiques générales -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Vue d'ensemble</h5>
                            <p>Nombre total d'étudiants actifs : <?= $stats['total_active_students'] ?></p>
                            <p>Moyenne de candidatures par étudiant : <?= $stats['avg_applications_per_student'] ?></p>
                        </div>
                    </div>
                </div>

                <!-- Distribution des statuts -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Statuts des candidatures</h5>
                            <?php if (!empty($stats['application_status_distribution'])): ?>
                                <?php foreach ($stats['application_status_distribution'] as $status): ?>
                                    <div class="d-flex justify-content-between">
                                        <span><?= ucfirst($status['status']) ?></span>
                                        <span class="badge bg-primary"><?= $status['count'] ?></span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Aucune candidature enregistrée</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top étudiants actifs -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Top 5 des étudiants les plus actifs</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Nombre de candidatures</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($stats['top_active_students'])): ?>
                                    <?php foreach ($stats['top_active_students'] as $student): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($student['name']) ?></td>
                                            <td><?= $student['application_count'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2" class="text-center">Aucune donnée disponible</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Statistiques mensuelles -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Évolution mensuelle des candidatures</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Mois</th>
                                    <th>Nombre de candidatures</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($stats['monthly_applications'])): ?>
                                    <?php foreach ($stats['monthly_applications'] as $month): ?>
                                        <tr>
                                            <td><?= date('F Y', strtotime($month['month'] . '-01')) ?></td>
                                            <td><?= $month['total_applications'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2" class="text-center">Aucune donnée disponible</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>