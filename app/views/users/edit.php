<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Modifier un utilisateur</h1>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger"><?= $error ?></div>
                            <?php endif; ?>

                            <form method="POST" action="/srx/users/edit/<?= $user['id'] ?>" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Nom d'utilisateur *</label>
                                    <input type="text" class="form-control" id="username" name="username" 
                                           value="<?= htmlspecialchars($user['username']) ?>" required>
                                    <div class="invalid-feedback">
                                        Le nom d'utilisateur est requis
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?= htmlspecialchars($user['email']) ?>" required>
                                    <div class="invalid-feedback">
                                        L'email est requis et doit être valide
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <div class="form-text">
                                        Laissez vide pour conserver le mot de passe actuel
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="role_id" class="form-label">Rôle *</label>
                                    <select class="form-select" id="role_id" name="role_id" required>
                                        <option value="">Sélectionnez un rôle</option>
                                        <?php foreach ($roles as $role): ?>
                                            <option value="<?= $role['id'] ?>" 
                                                    <?= $user['role_id'] == $role['id'] ? 'selected' : '' ?>>
                                                <?= ucfirst($role['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Le rôle est requis
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="/srx/users" class="btn btn-secondary">Annuler</a>
                                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
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
                                <li><i class="bi bi-info-circle"></i> Le mot de passe n'est modifié que s'il est renseigné</li>
                                <li><i class="bi bi-info-circle"></i> L'email doit être unique dans le système</li>
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