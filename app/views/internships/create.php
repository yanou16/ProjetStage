<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Créer une offre de stage</h1>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger"><?= $error ?></div>
                            <?php endif; ?>

                            <form method="POST" action="/srx/internships/create" class="needs-validation" novalidate>
                                <!-- Informations générales -->
                                <div class="mb-4">
                                    <h5 class="card-title">Informations générales</h5>
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Titre du stage *</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                        <div class="invalid-feedback">
                                            Le titre du stage est requis
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="company_id" class="form-label">Entreprise *</label>
                                        <select class="form-select" id="company_id" name="company_id" required>
                                            <option value="">Sélectionnez une entreprise</option>
                                            <?php foreach ($companies as $company): ?>
                                                <option value="<?= $company['id'] ?>"><?= htmlspecialchars($company['name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            L'entreprise est requise
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description du stage *</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                                        <div class="invalid-feedback">
                                            La description du stage est requise
                                        </div>
                                    </div>
                                </div>

                                <!-- Détails du stage -->
                                <div class="mb-4">
                                    <h5 class="card-title">Détails du stage</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="start_date" class="form-label">Date de début *</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                                            <div class="invalid-feedback">
                                                La date de début est requise
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="duration" class="form-label">Durée (en semaines) *</label>
                                            <input type="number" class="form-control" id="duration" name="duration" min="1" required>
                                            <div class="invalid-feedback">
                                                La durée est requise
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="skills_required" class="form-label">Compétences requises *</label>
                                        <textarea class="form-control" id="skills_required" name="skills_required" rows="3" required></textarea>
                                        <div class="invalid-feedback">
                                            Les compétences requises sont requises
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="compensation" class="form-label">Gratification (€/mois)</label>
                                        <input type="number" class="form-control" id="compensation" name="compensation" min="0" step="0.01">
                                        <div class="invalid-feedback">
                                            La gratification doit être un nombre positif
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="/srx/internships" class="btn btn-secondary">Annuler</a>
                                    <button type="submit" class="btn btn-primary">Publier l'offre</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Aide et instructions -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Instructions</h5>
                            <p class="card-text">
                                Les champs marqués d'un astérisque (*) sont obligatoires.
                            </p>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-info-circle"></i> Le titre doit être clair et concis</li>
                                <li><i class="bi bi-info-circle"></i> La description doit détailler les missions</li>
                                <li><i class="bi bi-info-circle"></i> Les compétences doivent être listées précisément</li>
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
</script>