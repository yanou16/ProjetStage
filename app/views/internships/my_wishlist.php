<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><?= $title ?></h1>
            </div>

            <?php if (empty($wishlist)): ?>
                <div class="alert alert-info">
                    Votre liste de souhaits est vide.
                    <a href="/srx/internships" class="alert-link">Parcourir les stages</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Stage</th>
                                <th>Entreprise</th>
                                <th>Ajouté le</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($wishlist as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['internship_title']) ?></td>
                                    <td>
                                        <a href="/srx/companies/view/<?= $item['company_id'] ?>">
                                            <?= htmlspecialchars($item['company_name']) ?>
                                        </a>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($item['created_at'])) ?></td>
                                    <td>
                                        <a href="/srx/internships/view/<?= $item['internship_id'] ?>" 
                                           class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> Voir le stage
                                        </a>
                                        <form action="/srx/internships/toggleWishlist/<?= $item['internship_id'] ?>" 
                                              method="POST" class="d-inline">
                                            <button type="submit" class="btn btn-sm btn-warning">
                                                <i class="bi bi-star-fill"></i> Retirer
                                            </button>
                                        </form>
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