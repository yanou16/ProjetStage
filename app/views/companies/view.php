<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><?= htmlspecialchars($company['name']) ?></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                        <a href="/srx/companies/edit/<?= $company['id'] ?>" class="btn btn-sm btn-outline-secondary me-2">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                    <?php endif; ?>
                    <a href="/srx/companies" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- Informations de l'entreprise -->
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Informations générales</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Industrie:</strong> <?= htmlspecialchars($company['industry'] ?? 'Non spécifié') ?></p>
                                    <p><strong>Email:</strong> <?= htmlspecialchars($company['email'] ?? 'Non spécifié') ?></p>
                                    <p><strong>Téléphone:</strong> <?= htmlspecialchars($company['phone'] ?? 'Non spécifié') ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Adresse:</strong> <?= htmlspecialchars($company['address'] ?? 'Non spécifié') ?></p>
                                    <p><strong>Ville:</strong> <?= htmlspecialchars($company['city'] ?? 'Non spécifié') ?></p>
                                    <p><strong>Pays:</strong> <?= htmlspecialchars($company['country'] ?? 'Non spécifié') ?></p>
                                </div>
                            </div>
                            <?php if (!empty($company['website'])): ?>
                                <p><strong>Site web:</strong> <a href="<?= htmlspecialchars($company['website']) ?>" target="_blank"><?= htmlspecialchars($company['website']) ?></a></p>
                            <?php endif; ?>
                            <?php if (!empty($company['description'])): ?>
                                <h5 class="mt-4">À propos</h5>
                                <p class="card-text"><?= nl2br(htmlspecialchars($company['description'])) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Liste des stages -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Stages proposés</h5>
                            <?php if (!empty($internships)): ?>
                                <div class="list-group">
                                    <?php foreach ($internships as $internship): ?>
                                        <a href="/srx/internships/view/<?= $internship['id'] ?>" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1"><?= htmlspecialchars($internship['title']) ?></h6>
                                                <small class="text-muted">
                                                    <?= (new DateTime($internship['created_at']))->format('d/m/Y') ?>
                                                </small>
                                            </div>
                                            <p class="mb-1"><?= htmlspecialchars(substr($internship['description'], 0, 150)) ?>...</p>
                                            <small class="text-muted">
                                                Durée: <?= $internship['duration'] ?> semaines | 
                                                Début: <?= (new DateTime($internship['start_date']))->format('d/m/Y') ?>
                                            </small>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-muted">Aucun stage disponible pour le moment.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Carte et informations complémentaires -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Localisation</h5>
                            <?php if (!empty($company['address']) && !empty($company['city'])): ?>
                                <div class="ratio ratio-4x3 mb-3">
                                    <iframe 
                                        width="100%" 
                                        height="100%" 
                                        frameborder="0" 
                                        scrolling="no" 
                                        marginheight="0" 
                                        marginwidth="0" 
                                        src="https://maps.google.com/maps?q=<?= urlencode($company['address'] . ', ' . $company['city'] . ', ' . $company['country']) ?>&output=embed">
                                    </iframe>
                                </div>
                            <?php else: ?>
                                <p class="text-muted">Adresse non disponible</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Statistiques -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Statistiques</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="bi bi-briefcase"></i> 
                                    <?= count($internships) ?> stage(s) proposé(s)
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-calendar"></i> 
                                    Membre depuis <?= (new DateTime($company['created_at']))->format('d/m/Y') ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>