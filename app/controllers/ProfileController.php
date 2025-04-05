<?php

class ProfileController extends Controller {
    public function __construct() {
        parent::__construct();
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            header('Location: /srx/users/login');
            exit;
        }
    }

    public function index() {
        // Récupérer les données de l'utilisateur
        $user = $_SESSION['user'];
        
        // Si l'utilisateur est un étudiant, récupérer les statistiques
        if ($user['role'] === 'student') {
            // Vous devrez adapter ces requêtes selon votre structure de base de données
            $db = Database::getInstance();
            
            // Compter les candidatures
            $stmt = $db->prepare("SELECT COUNT(*) as count FROM applications WHERE user_id = ?");
            $stmt->execute([$user['id']]);
            $applications = $stmt->fetch();
            $user['applications_count'] = $applications['count'];
            
            // Compter les favoris
            $stmt = $db->prepare("SELECT COUNT(*) as count FROM wishlist WHERE user_id = ?");
            $stmt->execute([$user['id']]);
            $wishlist = $stmt->fetch();
            $user['wishlist_count'] = $wishlist['count'];
            
            // Compter les candidatures acceptées
            $stmt = $db->prepare("SELECT COUNT(*) as count FROM applications WHERE user_id = ? AND status = 'accepted'");
            $stmt->execute([$user['id']]);
            $accepted = $stmt->fetch();
            $user['accepted_applications'] = $accepted['count'];
        }
        
        // Mettre à jour les données de session avec les statistiques
        $_SESSION['user'] = $user;
        
        // Charger la vue avec renderView au lieu de view
        $this->renderView('users/profile', [
            'title' => 'Mon Profil - StageFlow',
            'user' => $user
        ]);
    }
} 