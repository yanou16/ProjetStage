<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><?= htmlspecialchars($internship['title']) ?></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <?php if (isset($_SESSION['user']) && ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'pilote')): ?>
                        <a href="/srx/internships/edit/<?= $internship['id'] ?>" class="btn btn-sm btn-outline-secondary me-2">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                    <?php endif; ?>
                    <a href="/srx/internships" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- Détails du stage -->
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Description du poste</h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($internship['description'])) ?></p>

                            <h5 class="mt-4">Compétences requises</h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($internship['skills_required'])) ?></p>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h5>Informations pratiques</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>Date de début:</strong> <?= (new DateTime($internship['start_date']))->format('d/m/Y') ?></li>
                                        <li><strong>Durée:</strong> <?= $internship['duration'] ?> semaines</li>
                                        <?php if ($internship['compensation']): ?>
                                            <li><strong>Compensation:</strong> <?= number_format($internship['compensation'], 2, ',', ' ') ?> €</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5>Statut</h5>
                                    <span class="badge bg-<?= $internship['status'] === 'published' ? 'success' : ($internship['status'] === 'draft' ? 'warning' : 'danger') ?>">
                                        <?= ucfirst($internship['status']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions pour les étudiants -->
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'student'): ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Actions</h5>
                                
                                <!-- Bouton Wishlist -->
                                <form action="/srx/internships/toggleWishlist/<?= $internship['id'] ?>" method="POST" class="d-inline">
                                    <button type="submit" class="btn <?= $isInWishlist ? 'btn-warning' : 'btn-outline-warning' ?> me-2">
                                        <i class="bi bi-star<?= $isInWishlist ? '-fill' : '' ?>"></i>
                                        <?= $isInWishlist ? 'Retirer des favoris' : 'Ajouter aux favoris' ?>
                                    </button>
                                </form>

                                <!-- Bouton Postuler -->
                                <?php if (!$hasApplied): ?>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#applyModal">
                                        <i class="bi bi-envelope"></i> Postuler
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-secondary" disabled>
                                        <i class="bi bi-check-circle"></i> Déjà postulé
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Modal de candidature -->
                        <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="/srx/internships/apply/<?= $internship['id'] ?>" method="POST" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="applyModalLabel">Postuler au stage</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- CV Upload -->
                                            <div class="mb-3">
                                                <label for="cv" class="form-label">CV (PDF uniquement)</label>
                                                <input type="file" class="form-control" id="cv" name="cv" accept=".pdf" required>
                                                <div class="form-text">Taille maximale : 5 MB</div>
                                            </div>

                                            <!-- Message de motivation -->
                                            <div class="mb-3">
                                                <label for="message" class="form-label">Message de motivation</label>
                                                <textarea class="form-control" id="message" name="message" rows="5" required
                                                        placeholder="Expliquez pourquoi vous êtes intéressé par ce stage et ce que vous pouvez apporter à l'entreprise..."></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-success">
                                                <i class="bi bi-send"></i> Envoyer ma candidature
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Informations sur l'entreprise -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">À propos de l'entreprise</h5>
                            <h6 class="card-subtitle mb-2">
                                <a href="/srx/companies/view/<?= $company['id'] ?>" class="text-decoration-none">
                                    <?= htmlspecialchars($company['name']) ?>
                                </a>
                            </h6>
                            <p class="card-text"><?= nl2br(htmlspecialchars(substr($company['description'], 0, 200))) ?>...</p>
                            
                            <h6 class="mt-4">Contact</h6>
                            <ul class="list-unstyled">
                                <?php if (!empty($company['email'])): ?>
                                    <li><i class="bi bi-envelope"></i> <?= htmlspecialchars($company['email']) ?></li>
                                <?php endif; ?>
                                <?php if (!empty($company['phone'])): ?>
                                    <li><i class="bi bi-telephone"></i> <?= htmlspecialchars($company['phone']) ?></li>
                                <?php endif; ?>
                                <?php if (!empty($company['website'])): ?>
                                    <li><i class="bi bi-globe"></i> <a href="<?= htmlspecialchars($company['website']) ?>" target="_blank"><?= htmlspecialchars($company['website']) ?></a></li>
                                <?php endif; ?>
                            </ul>

                            <h6 class="mt-4">Localisation</h6>
                            <p>
                                <?= htmlspecialchars($company['address']) ?><br>
                                <?= htmlspecialchars($company['city']) ?>, <?= htmlspecialchars($company['country']) ?>
                            </p>
                        </div>
                    </div>

                    <!-- Statistiques -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Statistiques</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="bi bi-clock"></i> 
                                    Publié le <?= (new DateTime($internship['created_at']))->format('d/m/Y') ?>
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-eye"></i> 
                                    0 vues
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-person"></i> 
                                    0 candidatures
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>