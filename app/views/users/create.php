<?php
// Extraction des variables
if (isset($data)) {
    extract($data);
}
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $title ?? 'Créer un compte' ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="/srx/users" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="/srx/users/create" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="username" class="form-label">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                            <div class="invalid-feedback">
                                Le nom d'utilisateur est requis
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">
                                Un email valide est requis
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

                        <div class="mb-3">
                            <label for="role_id" class="form-label">Type de compte</label>
                            <select class="form-select" id="role_id" name="role_id" required>
                                <option value="">Choisir un type de compte...</option>
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Le type de compte est requis
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Créer le compte</button>
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
                } else {
                    // Vérification des mots de passe
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