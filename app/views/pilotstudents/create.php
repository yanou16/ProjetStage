<?php
// Extraction des variables
if (isset($data)) {
    extract($data);
}
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $title ?? 'Ajouter un étudiant' ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="/srx/pilot_students" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <?php if (isset($_SESSION['flash_message'])): ?>
    <div class="alert alert-<?= $_SESSION['flash_message']['type'] ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['flash_message']['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php 
        unset($_SESSION['flash_message']);
    endif; 
    ?>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="/srx/pilot_students/create" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Nom *</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                            <div class="invalid-feedback">
                                Le nom est requis
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="firstname" class="form-label">Prénom *</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                            <div class="invalid-feedback">
                                Le prénom est requis
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">
                                Un email valide est requis
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe *</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div class="invalid-feedback">
                                Le mot de passe est requis
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="promotion_id" class="form-label">Promotion *</label>
                            <select class="form-select" id="promotion_id" name="promotion_id" required>
                                <option value="">Sélectionnez une promotion</option>
                                <?php if (!empty($promotions)): ?>
                                    <?php foreach ($promotions as $promotion): ?>
                                        <option value="<?= $promotion['id'] ?>">
                                            <?= htmlspecialchars($promotion['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <div class="invalid-feedback">
                                Veuillez sélectionner une promotion
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Créer l'étudiant
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validation des formulaires Bootstrap
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