<div class="row">
    <div class="col-md-8 offset-md-2">
        <h1 class="mb-4"><?= $title ?></h1>
        <div class="card">
            <div class="card-body">
                <form method="post" action="/srx/contact/send">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Informations de contact</h5>
                <p class="card-text">
                    <strong>Adresse :</strong> 123 Rue Example, Ville<br>
                    <strong>Email :</strong> contact@monsite.com<br>
                    <strong>Téléphone :</strong> +33 1 23 45 67 89
                </p>
            </div>
        </div>
    </div>
</div>