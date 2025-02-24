<?php

class UsersController extends Controller {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = $this->loadModel('User');
    }

    public function index() {
        // Vérifier si l'utilisateur est admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $this->setFlashMessage('danger', 'Accès non autorisé');
            $this->redirect('/srx');
        }

        $data = [
            'title' => 'Gestion des utilisateurs',
            'users' => $this->userModel->getAllUsers()
        ];

        $this->renderView('users/index', $data);
    }

    public function create() {
        // Vérifier si l'utilisateur est admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $this->setFlashMessage('danger', 'Accès non autorisé');
            $this->redirect('/srx');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validation des données
            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => $_POST['password'],
                'role_id' => $_POST['role_id']
            ];

            // Vérifier que tous les champs sont remplis
            if (empty($data['username']) || empty($data['email']) || 
                empty($data['password']) || empty($data['role_id'])) {
                $this->setFlashMessage('danger', 'Veuillez remplir tous les champs');
            } else {
                // Vérifier si l'email existe déjà
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $this->setFlashMessage('danger', 'Cet email est déjà utilisé');
                } else {
                    // Hasher le mot de passe
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Créer l'utilisateur
                    if ($this->userModel->create($data)) {
                        $this->setFlashMessage('success', 'Compte créé avec succès');
                        $this->redirect('/srx/users');
                        return;
                    } else {
                        $this->setFlashMessage('danger', 'Erreur lors de la création du compte');
                    }
                }
            }
        }

        $data = [
            'title' => 'Créer un compte',
            'roles' => [
                ['id' => 2, 'name' => 'Pilote'],
                ['id' => 3, 'name' => 'Étudiant']
            ]
        ];

        $this->renderView('users/create', $data);
    }

    public function edit($id = null) {
        // Vérifier si l'utilisateur est admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $this->setFlashMessage('danger', 'Accès non autorisé');
            $this->redirect('/srx');
        }

        if (!$id) {
            $this->setFlashMessage('danger', 'ID utilisateur non spécifié');
            $this->redirect('/srx/users');
        }

        $user = $this->userModel->findById($id);
        if (!$user) {
            $this->setFlashMessage('danger', 'Utilisateur non trouvé');
            $this->redirect('/srx/users');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'role_id' => $_POST['role_id']
            ];

            // Ajouter le mot de passe uniquement s'il est fourni
            if (!empty($_POST['password'])) {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }

            if ($this->userModel->update($id, $data)) {
                $this->setFlashMessage('success', 'Utilisateur modifié avec succès');
                $this->redirect('/srx/users');
            } else {
                $this->setFlashMessage('danger', 'Erreur lors de la modification');
            }
        }

        $data = [
            'title' => 'Modifier un utilisateur',
            'user' => $user,
            'roles' => [
                ['id' => 1, 'name' => 'admin'],
                ['id' => 2, 'name' => 'pilote'],
                ['id' => 3, 'name' => 'student']
            ]
        ];

        $this->renderView('users/edit', $data);
    }
}