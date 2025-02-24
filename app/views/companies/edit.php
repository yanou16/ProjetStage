<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Modifier l'entreprise : <?= htmlspecialchars($company['name']) ?></h1>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger"><?= $error ?></div>
                            <?php endif; ?>

                            <form method="POST" action="/srx/companies/edit/<?= $company['id'] ?>" class="needs-validation" novalidate>
                                <!-- Informations générales -->
                                <div class="mb-4">
                                    <h5 class="card-title">Informations générales</h5>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nom de l'entreprise *</label>
                                        <input type="text" class="form-control" id="name" name="name" 
                                               value="<?= htmlspecialchars($company['name']) ?>" required>
                                        <div class="invalid-feedback">
                                            Le nom de l'entreprise est requis
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="industry" class="form-label">Secteur d'activité *</label>
                                        <select class="form-select" id="industry" name="industry" required>
                                            <option value="">Sélectionnez un secteur</option>
                                            <?php
                                            $industries = [
                                                'Technology' => 'Technologies',
                                                'Finance' => 'Finance',
                                                'Healthcare' => 'Santé',
                                                'Education' => 'Éducation',
                                                'Manufacturing' => 'Industrie',
                                                'Retail' => 'Commerce',
                                                'Services' => 'Services',
                                                'Other' => 'Autre'
                                            ];
                                            foreach ($industries as $value => $label): ?>
                                                <option value="<?= $value ?>" <?= $company['industry'] === $value ? 'selected' : '' ?>>
                                                    <?= $label ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Veuillez sélectionner un secteur d'activité
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description de l'entreprise *</label>
                                        <textarea class="form-control" id="description" name="description" 
                                                  rows="4" required><?= htmlspecialchars($company['description']) ?></textarea>
                                        <div class="invalid-feedback">
                                            Une description de l'entreprise est requise
                                        </div>
                                    </div>
                                </div>

                                <!-- Localisation -->
                                <div class="mb-4">
                                    <h5 class="card-title">Localisation</h5>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Adresse *</label>
                                        <input type="text" class="form-control" id="address" name="address" 
                                               value="<?= htmlspecialchars($company['address']) ?>" required>
                                        <div class="invalid-feedback">
                                            L'adresse est requise
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="city" class="form-label">Ville *</label>
                                            <input type="text" class="form-control" id="city" name="city" 
                                                   value="<?= htmlspecialchars($company['city']) ?>" required>
                                            <div class="invalid-feedback">
                                                La ville est requise
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="country" class="form-label">Pays *</label>
                                            <select class="form-select" id="country" name="country" required>
                                                <option value="">Sélectionnez un pays</option>
                                                <?php
                                                $countries = [
                                                    'FR' => 'France',
                                                    'BE' => 'Belgique',
                                                    'CH' => 'Suisse',
                                                    'LU' => 'Luxembourg'
                                                ];
                                                foreach ($countries as $code => $name): ?>
                                                    <option value="<?= $code ?>" <?= $company['country'] === $code ? 'selected' : '' ?>>
                                                        <?= $name ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Le pays est requis
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact -->
                                <div class="mb-4">
                                    <h5 class="card-title">Informations de contact</h5>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="<?= htmlspecialchars($company['email'] ?? '') ?>">
                                        <div class="invalid-feedback">
                                            Veuillez entrer une adresse email valide
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Téléphone</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" 
                                               value="<?= htmlspecialchars($company['phone'] ?? '') ?>" 
                                               pattern="[0-9]{10}">
                                        <div class="invalid-feedback">
                                            Veuillez entrer un numéro de téléphone valide
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="website" class="form-label">Site web</label>
                                        <input type="url" class="form-control" id="website" name="website" 
                                               value="<?= htmlspecialchars($company['website'] ?? '') ?>">
                                        <div class="invalid-feedback">
                                            Veuillez entrer une URL valide
                                        </div>
                                    </div>
                                </div>

                                <!-- Historique des modifications -->
                                <div class="mb-4">
                                    <h5 class="card-title">Historique</h5>
                                    <div class="text-muted small">
                                        <p>Créé le : <?= date('d/m/Y H:i', strtotime($company['created_at'])) ?></p>
                                        <?php if (isset($company['updated_at'])): ?>
                                            <p>Dernière modification : <?= date('d/m/Y H:i', strtotime($company['updated_at'])) ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="/srx/companies" class="btn btn-secondary">Annuler</a>
                                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Panneau latéral -->
                <div class="col-md-4">
                    <!-- Statistiques de l'entreprise -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Statistiques</h5>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-briefcase"></i> Offres de stage : <?= $company['internship_count'] ?? 0 ?></li>
                                <li><i class="bi bi-file-text"></i> Candidatures reçues : <?= $company['application_count'] ?? 0 ?></li>
                                <li><i class="bi bi-star"></i> Note moyenne : <?= number_format($company['avg_rating'] ?? 0, 1) ?>/5</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Instructions -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Instructions</h5>
                            <p class="card-text">
                                Les champs marqués d'un astérisque (*) sont obligatoires.
                            </p>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-info-circle"></i> Le nom de l'entreprise doit être unique</li>
                                <li><i class="bi bi-info-circle"></i> La description doit être concise et informative</li>
                                <li><i class="bi bi-info-circle"></i> L'adresse sera utilisée pour la géolocalisation</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
// Validation du formulaire
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()

// Formatage automatique du numéro de téléphone
document.getElementById('phone').addEventListener('input', function(e) {
    let x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,2})(\d{0,2})(\d{0,2})(\d{0,2})/);
    e.target.value = !x[2] ? x[1] : x[1] + ' ' + x[2] + (x[3] ? ' ' + x[3] : '') + (x[4] ? ' ' + x[4] : '') + (x[5] ? ' ' + x[5] : '');
});
</script>