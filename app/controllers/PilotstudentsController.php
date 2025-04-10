<?php

class PilotstudentsController extends Controller {
    private $studentModel;
    private $promotionModel;

    public function __construct() {
        parent::__construct();
        // Vérifier si l'utilisateur est connecté et est un pilote
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'pilote') {
            header('Location: /srx/users/login');
            exit;
        }
        $this->studentModel = new Student();
        $this->promotionModel = new Promotion();
    }

    public function index() {
        try {
            // Récupérer tous les utilisateurs qui sont des étudiants (role_id = 3)
            $query = "SELECT u.*, r.name as role 
                     FROM users u 
                     INNER JOIN roles r ON u.role_id = r.id 
                     WHERE r.name = 'student' 
                     ORDER BY u.created_at DESC";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Charger la vue avec les données
            $this->renderView('users/index', [
                'users' => $users,
                'title' => 'Mes Étudiants'
            ]);
        } catch (PDOException $e) {
            $_SESSION['flash_message'] = [
                'type' => 'danger',
                'message' => 'Une erreur est survenue lors de la récupération des étudiants.'
            ];
            $this->renderView('users/index', [
                'users' => [],
                'title' => 'Mes Étudiants'
            ]);
        }
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validation des données
            $errors = [];
            if (empty($_POST['firstname'])) $errors[] = "Le prénom est requis";
            if (empty($_POST['lastname'])) $errors[] = "Le nom est requis";
            if (empty($_POST['email'])) $errors[] = "L'email est requis";
            if (empty($_POST['password'])) $errors[] = "Le mot de passe est requis";
            if (empty($_POST['promotion_id'])) $errors[] = "La promotion est requise";

            if (empty($errors)) {
                if ($this->studentModel->create($_POST)) {
                    $_SESSION['flash_message'] = [
                        'type' => 'success',
                        'message' => 'Étudiant créé avec succès'
                    ];
                    header('Location: /srx/pilotstudents');
                    exit;
                } else {
                    $errors[] = "Erreur lors de la création de l'étudiant";
                }
            }

            if (!empty($errors)) {
                $_SESSION['flash_message'] = [
                    'type' => 'danger',
                    'message' => implode('<br>', $errors)
                ];
            }
        }

        $data = [
            'title' => 'Ajouter un étudiant',
            'promotions' => $this->promotionModel->getAll()
        ];
        $this->renderView('pilotstudents/create', $data);
    }

    public function edit($id) {
        $student = $this->studentModel->find($id);
        
        // Vérifier si l'étudiant existe et appartient au pilote
        if (!$student || $student['pilot_id'] !== $_SESSION['user']['id']) {
            header('Location: /srx/pilotstudents');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->studentModel->update($id, $_POST)) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Étudiant modifié avec succès'
                ];
                header('Location: /srx/pilotstudents');
                exit;
            }
        }

        $data = [
            'title' => 'Modifier un étudiant',
            'student' => $student,
            'promotions' => $this->promotionModel->getAll()
        ];
        $this->renderView('pilotstudents/edit', $data);
    }

    public function delete($id) {
        $student = $this->studentModel->find($id);
        
        // Vérifier si l'étudiant existe et appartient au pilote
        if (!$student || $student['pilot_id'] !== $_SESSION['user']['id']) {
            header('Location: /srx/pilotstudents');
            exit;
        }

        if ($this->studentModel->delete($id)) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Étudiant supprimé avec succès'
            ];
        }
        header('Location: /srx/pilotstudents');
        exit;
    }
}