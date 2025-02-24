<?php

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = $this->loadModel('User');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Vérifier si l'utilisateur existe
            $user = $this->userModel->findUserByEmail($email);

            // Débogage
            if ($user) {
                // L'utilisateur existe, vérifions le mot de passe
                if (password_verify($password, $user['password'])) {
                    // Le mot de passe est correct
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $this->getRoleName($user['role_id'])
                    ];

                    $this->setFlashMessage('success', 'Connexion réussie');
                    $this->redirect('/srx');
                } else {
                    // Le mot de passe est incorrect
                    $this->setFlashMessage('danger', 'Mot de passe incorrect');
                    $this->redirect('/srx/auth/login');
                }
            } else {
                // L'utilisateur n'existe pas
                $this->setFlashMessage('danger', 'Email non trouvé');
                $this->redirect('/srx/auth/login');
            }
        }

        $data = [
            'title' => 'Connexion'
        ];

        $this->renderView('auth/login', $data);
    }

    public function logout() {
        // Détruire la session
        session_destroy();
        $this->redirect('/srx/auth/login');
    }

    private function getRoleName($roleId) {
        switch ($roleId) {
            case 1:
                return 'admin';
            case 2:
                return 'pilote';
            case 3:
                return 'student';
            default:
                return 'user';
        }
    }
}