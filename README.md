# Plateforme de Gestion des Stages CESI: Stageflow

Une application web complète pour faciliter la recherche et la gestion des stages pour les étudiants du CESI.

## 📋 Description

Stageflow permet aux étudiants de rechercher des stages, aux entreprises de publier leurs offres, et aux pilotes de promotion de suivre les candidatures. Le site centralise toutes les informations relatives aux stages et facilite la mise en relation entre les étudiants et les entreprises.

## ✨ Fonctionnalités Principales

### Pour les Étudiants
- Recherche d'offres de stage par compétences
- Gestion d'une wishlist personnalisée
- Soumission de candidatures (CV + lettre de motivation)
- Suivi des candidatures
- Évaluation des entreprises post-stage

### Pour les Pilotes
- Suivi des étudiants
- Gestion des offres de stage
- Accès aux statistiques de candidature
- Gestion des comptes étudiants

### Pour les Administrateurs
- Gestion complète des utilisateurs
- Administration des entreprises
- Supervision globale de la plateforme
- Accès aux tableaux de bord statistiques

## 🛠 Stack Technique

- **Front-end:**
  - HTML5
  - CSS3
  - JavaScript
  - Design Responsive
  
- **Back-end:**
  - PHP (Architecture MVC)
  - Apache
  - Base de données SQL
  
- **Sécurité:**
  - Validation des formulaires (front & back)
  - Protection contre les injections SQL
  - Cryptage des données sensibles
  - Gestion sécurisée des sessions

## 🚀 Installation

1. Cloner le repository
```bash
git clone https://github.com/[votre-username]/stage-platform.git
```

2. Configurer la base de données
```bash
# Importer le fichier SQL fourni dans votre SGBD
mysql -u [username] -p [database_name] < database/structure.sql
```

3. Configurer le virtual host Apache
```apache
# Exemple de configuration vhost
<VirtualHost *:80>
    ServerName stage-platform.local
    DocumentRoot "/path/to/project/public"
    
    <Directory "/path/to/project/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

4. Configurer les variables d'environnement
```bash
cp .env.example .env
# Éditer le fichier .env avec vos paramètres
```

## 📝 Structure du Projet

```
stage-platform/
├── app/
│   ├── Controllers/
│   ├── Models/
│   └── Views/
├── public/
│   ├── css/
│   ├── js/
│   └── images/
├── config/
├── database/
└── tests/
```

## 🔒 Exigences

- PHP 8.0 ou supérieur
- MySQL 5.7 ou supérieur
- Apache 2.4 ou supérieur

## ✍️ Auteurs
@shenzhenyz (Manil Doudou)
