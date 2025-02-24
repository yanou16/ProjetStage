<?php
// Extraction des variables
if (isset($data)) {
    extract($data);
}
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $title ?? 'Créer un pilote' ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="/srx/pilots" class="btn btn-sm btn-outline-secondary">
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
                    <form action="/srx/pilots/create" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                            <div class="invalid-feedback">
                                Le nom est requis
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="firstname" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                            <div class="invalid-feedback">
                                Le prénom est requis
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">
                                L'email est requis et doit être valide
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div class="invalid-feedback">
                                Le mot de passe est requis
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                            <div class="invalid-feedback">
                                La confirmation du mot de passe est requise
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Créer le pilote</button>
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

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                } else {
                    // Vérification de la correspondance des mots de passe
                    const password = document.getElementById('password')
                    const passwordConfirm = document.getElementById('password_confirm')
                    
                    if (password.value !== passwordConfirm.value) {
                        event.preventDefault()
                        event.stopPropagation()
                        passwordConfirm.setCustomValidity('Les mots de passe ne correspondent pas')
                    } else {
                        passwordConfirm.setCustomValidity('')
                    }
                }

                form.classList.add('was-validated')
            }, false)
        })
})()
</script>