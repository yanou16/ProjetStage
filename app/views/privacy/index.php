<?php
if (isset($data)) {
    extract($data);
}
?>

<section class="privacy-section">
    <div class="container">
        <h1 class="privacy-title">Politique de Confidentialité</h1>
        
        <div class="privacy-content">
            <div class="privacy-block">
                <h2>1. Collecte des Informations</h2>
                <p>Nous collectons les informations suivantes :</p>
                <ul>
                    <li>Nom et prénom</li>
                    <li>Adresse email</li>
                    <li>Informations académiques</li>
                    <li>CV et documents de candidature</li>
                </ul>
            </div>

            <div class="privacy-block">
                <h2>2. Utilisation des Informations</h2>
                <p>Vos informations sont utilisées pour :</p>
                <ul>
                    <li>Gérer votre compte et profil</li>
                    <li>Faciliter la recherche de stages</li>
                    <li>Communiquer avec les entreprises</li>
                    <li>Améliorer nos services</li>
                </ul>
            </div>

            <div class="privacy-block">
                <h2>3. Protection des Données</h2>
                <p>Nous mettons en œuvre des mesures de sécurité pour protéger vos informations personnelles conformément au RGPD.</p>
            </div>

            <div class="privacy-block">
                <h2>4. Vos Droits</h2>
                <p>Vous disposez des droits suivants :</p>
                <ul>
                    <li>Accès à vos données</li>
                    <li>Rectification de vos données</li>
                    <li>Suppression de vos données</li>
                    <li>Opposition au traitement</li>
                </ul>
            </div>

            <div class="privacy-block">
                <h2>5. Contact</h2>
                <p>Pour toute question concernant notre politique de confidentialité, contactez-nous à : privacy@srx.com</p>
            </div>
        </div>
    </div>
</section>

<style>
.privacy-section {
    padding: 4rem 0;
    background-color: #f8fafc;
}

.privacy-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 2rem;
    text-align: center;
}

.privacy-content {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.privacy-block {
    margin-bottom: 2rem;
}

.privacy-block h2 {
    color: #334155;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.privacy-block p {
    color: #475569;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.privacy-block ul {
    list-style-type: disc;
    margin-left: 1.5rem;
    color: #475569;
}

.privacy-block ul li {
    margin-bottom: 0.5rem;
}
</style>