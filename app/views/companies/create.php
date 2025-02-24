<?php
if (isset($data)) {
    extract($data);
}
?>

<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Créer une entreprise</h1>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger"><?= $error ?></div>
                            <?php endif; ?>

                            <form method="POST" action="/srx/companies/create" class="needs-validation" novalidate>
                                <!-- Informations générales -->
                                <div class="mb-4">
                                    <h5 class="card-title">Informations générales</h5>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nom de l'entreprise *</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                        <div class="invalid-feedback">
                                            Le nom de l'entreprise est requis
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="industry" class="form-label">Secteur d'activité *</label>
                                        <select class="form-select" id="industry" name="industry" required>
                                            <option value="">Sélectionnez un secteur</option>
                                            <option value="Technology">Technologies</option>
                                            <option value="Finance">Finance</option>
                                            <option value="Healthcare">Santé</option>
                                            <option value="Education">Éducation</option>
                                            <option value="Manufacturing">Industrie</option>
                                            <option value="Retail">Commerce</option>
                                            <option value="Services">Services</option>
                                            <option value="Other">Autre</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Veuillez sélectionner un secteur d'activité
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description de l'entreprise *</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
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
                                        <input type="text" class="form-control" id="address" name="address" required>
                                        <div class="invalid-feedback">
                                            L'adresse est requise
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="city" class="form-label">Ville *</label>
                                            <input type="text" class="form-control" id="city" name="city" required>
                                            <div class="invalid-feedback">
                                                La ville est requise
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="country" class="form-label">Pays *</label>
                                            <select class="form-select" id="country" name="country" required>
                                                <option value="">Sélectionnez un pays</option>
                                                <option value="FR">France</option>
                                                <option value="BE">Belgique</option>
                                                <option value="CH">Suisse</option>
                                                <option value="LU">Luxembourg</option>
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
                                        <input type="email" class="form-control" id="email" name="email">
                                        <div class="invalid-feedback">
                                            Veuillez entrer une adresse email valide
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Téléphone</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" 
                                               pattern="[0-9]{10}">
                                        <div class="invalid-feedback">
                                            Veuillez entrer un numéro de téléphone valide
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="website" class="form-label">Site web</label>
                                        <input type="url" class="form-control" id="website" name="website">
                                        <div class="invalid-feedback">
                                            Veuillez entrer une URL valide
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="/srx/companies" class="btn btn-secondary">Annuler</a>
                                    <button type="submit" class="btn btn-primary">Créer l'entreprise</button>
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
// Validation du formulaire côté client
(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
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