<?php

class DashboardController extends Controller {
    public function index() {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            header('Location: /srx/auth/login');
            exit;
        }

        $user = $_SESSION['user'];
        $data = [
            'title' => 'Tableau de bord',
            'user' => $user
        ];

        // Charger la vue appropriée selon le rôle
        switch ($user['role_name']) {
            case 'admin':
                $this->renderView('dashboard/admin', $data);
                break;
            case 'pilote':
                $this->renderView('dashboard/pilote', $data);
                break;
            default:
                $this->renderView('dashboard/student', $data);
        }
    }
}