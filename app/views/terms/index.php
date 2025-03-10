<?php
if (isset($data)) {
    extract($data);
}
?>

<section class="terms-section">
    <div class="container">
        <h1 class="terms-title">Conditions d'Utilisation</h1>
        
        <div class="terms-content">
            <div class="terms-block">
                <h2>1. Acceptation des Conditions</h2>
                <p>En accédant à cette plateforme, vous acceptez d'être lié par ces conditions d'utilisation, toutes les lois et réglementations applicables.</p>
            </div>

            <div class="terms-block">
                <h2>2. Utilisation de la Plateforme</h2>
                <p>Notre plateforme permet de :</p>
                <ul>
                    <li>Rechercher des stages</li>
                    <li>Postuler aux offres</li>
                    <li>Créer et gérer votre profil</li>
                    <li>Communiquer avec les entreprises</li>
                </ul>
            </div>

            <div class="terms-block">
                <h2>3. Compte Utilisateur</h2>
                <p>Les utilisateurs sont responsables de :</p>
                <ul>
                    <li>Maintenir la confidentialité de leur compte</li>
                    <li>Fournir des informations exactes</li>
                    <li>Mettre à jour leurs informations</li>
                </ul>
            </div>

            <div class="terms-block">
                <h2>4. Propriété Intellectuelle</h2>
                <p>Tout le contenu publié sur cette plateforme est la propriété de SRX ou de ses partenaires.</p>
            </div>

            <div class="terms-block">
                <h2>5. Responsabilités</h2>
                <p>SRX ne peut être tenu responsable :</p>
                <ul>
                    <li>Des contenus publiés par les utilisateurs</li>
                    <li>Des problèmes techniques temporaires</li>
                    <li>Des relations entre étudiants et entreprises</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<style>
.terms-section {
    padding: 4rem 0;
    background-color: #f8fafc;
}

.terms-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 2rem;
    text-align: center;
}

.terms-content {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.terms-block {
    margin-bottom: 2rem;
}

.terms-block h2 {
    color: #334155;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.terms-block p {
    color: #475569;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.terms-block ul {
    list-style-type: disc;
    margin-left: 1.5rem;
    color: #475569;
}

.terms-block ul li {
    margin-bottom: 0.5rem;
}
</style>