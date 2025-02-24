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
                            <p>Nombre total de stages : <?= $stats['total_internships'] ?></p>
                            <p>Nombre total de candidatures : <?= $stats['total_applications'] ?></p>
                        </div>
                    </div>
                </div>

                <!-- Distribution des statuts -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Statuts des candidatures</h5>
                            <?php if (!empty($stats['status_distribution'])): ?>
                                <?php foreach ($stats['status_distribution'] as $status): ?>
                                    <div class="d-flex justify-content-between">
                                        <span><?= ucfirst($status['status']) ?></span>
                                        <span class="badge bg-primary"><?= $status['count'] ?></span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Aucune candidature pour le moment</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top des stages -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= isset($_SESSION['user']['company_id']) ? 'Vos stages' : 'Top 5 des stages les plus demandés' ?>
                    </h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Stage</th>
                                    <th>Nombre de candidatures</th>
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
                                        <td><?= $internship['applications_count'] ?></td>
                                        <td>
                                            <a href="/srx/internships/view/<?= $internship['id'] ?>" 
                                               class="btn btn-sm btn-primary">
                                                Voir les détails
                                            </a>
                                        </td>
                                    </tr>
                                <?php 
                                    endforeach;
                                else:
                                ?>
                                    <tr>
                                        <td colspan="3" class="text-center">Aucun stage disponible</td>
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